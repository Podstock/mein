export default () => ({
    users: [],

    speakers() {
        return this.users.filter((user) => user.type == 'speaker');
    },
    listeners() {
        return this.users.filter((user) => user.type == 'listener');
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
    listen(roomId) {
        Echo.join("users." + roomId)
            .here((users) => {
                this.users = users;
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
            .error((error) => {
                console.error(error);
            });
    },
});
