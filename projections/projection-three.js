fromCategory('player')
    .foreachStream()
    .when({

        "init": function(state, event) {

            state.army1_race = event.data.army[1][0];
            state.army1_health = event.data.army[1][1];
            state.army1_strength = event.data.army[1][2];

            state.army2_race = event.data.army[0][0];
            state.army2_health = event.data.army[0][1];
            state.army2_strength = event.data.army[0][2];

            state.army3_race = event.data.army[2][0];
            state.army3_health = event.data.army[2][1];
            state.army3_strength = event.data.army[2][2];

            state.army4_race = event.data.army[3][0];
            state.army4_health = event.data.army[3][1];
            state.army4_strength = event.data.army[3][2];

            state.opposingArmy1_race = event.data.opposingArmy[1][0];
            state.opposingArmy1_health = event.data.opposingArmy[1][1];
            state.opposingArmy1_strength = event.data.opposingArmy[1][2];

            state.opposingArmy2_race = event.data.opposingArmy[0][0];
            state.opposingArmy2_health = event.data.opposingArmy[0][1];
            state.opposingArmy2_strength = event.data.opposingArmy[0][2];

            state.opposingArmy3_race = event.data.opposingArmy[2][0];
            state.opposingArmy3_health = event.data.opposingArmy[2][1];
            state.opposingArmy3_strength = event.data.opposingArmy[2][2];

            state.opposingArmy4_race = event.data.opposingArmy[3][0];
            state.opposingArmy4_health = event.data.opposingArmy[3][1];
            state.opposingArmy4_strength = event.data.opposingArmy[3][2];
        },

        "round": function (state, event) {
            state.count += 1
            return state

        }
        
        
        
        
    });