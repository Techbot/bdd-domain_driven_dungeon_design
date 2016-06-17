fromStream("DDDD")
    .when({
        $init: function () {
            return {
                count: 0
            }
        },
        "round": function (state, event) {
            state.count += 1
            return state
        },
    })
