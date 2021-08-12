export default () => ({
    users: [],

    speakers() {
        return this.users.filter((user) => user.type == "speaker");
    },
    listeners() {
        return this.users.filter((user) => user.type == "listener");
    },
    raiseHand(userId) {
        this.users.forEach((u) => {
            if (u.id == userId) {
                this.users = this.users.filter((user) => user.id !== userId);
                this.users.unshift(u);
                u.hand = true;
            }
        });
    },
    unraiseHand(userId) {
        this.users.forEach((u) => {
            if (u.id == userId) {
                u.hand = false;
            }
        });
    },
    talk(userId) {
        this.users.forEach((u) => {
            u.talk = false;
            if (u.id == userId) {
                u.talk = true;
            }
        });
    },
    listen(roomSlug) {
        Echo.join("users." + roomSlug)
            .here((users) => {
                this.users = users;

                this.users.forEach((u) => {
                    if (u.id == window.user_id) {
                        window.user = u;
                    }
                });
            })
            .joining((user) => {
                this.users.push(user);
            })
            .leaving((user) => {
                this.users = this.users.filter((u) => u.id !== user.id);
            })
            .listen("RaiseHand", (e) => {
                this.raiseHand(e.userId);
            })
            .listen("UnraiseHand", (e) => {
                this.unraiseHand(e.userId);
            })
            .listen("UserRejoin", (e) => {
                if (e.userId == window.user_id) this.rejoin(e.roomSlug);
            })
            .listen("WebrtcTalk", (e) => {
                this.talk(e.userId);
            })
            .error((error) => {
                console.error(error);
            });
    },
    rejoin(roomSlug) {
        console.log("users: rejoin " + roomSlug);
        Echo.leave("users." + roomSlug);
        this.listen(roomSlug);
    },
});
