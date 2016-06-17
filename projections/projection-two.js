fromStream('DDDD')
    .whenAny(function(state, event) {
        linkTo('player-' + event.data.player, event)
    })