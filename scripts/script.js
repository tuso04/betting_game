function updateGameday(currentGameday, selectedDate) {
    $.ajax({
        url: '../functions/updateGameday.php',
        type: 'POST',
        data: {
            currentGameday: currentGameday,
            selectedDate: selectedDate
        },
        success: function(response) {
            console.log(response);
            var teams = JSON.parse(response);  

            // Update the dependent variable in the HTML
            for (let i = 0; i < teams.teamsHome.length; i++) {
                $('#home-team-'+(i+1)+'-name').text(teams.teamsHome[i].name);
                $('#away-team-'+(i+1)+'-name').text(teams.teamsAway[i].name);
                $('#home-team-'+(i+1)+'-logo').find('img').attr('src', teams.teamsHome[i].logo);
                $('#away-team-'+(i+1)+'-logo').find('img').attr('src', teams.teamsAway[i].logo);
                $('#home-team-'+(i+1)+'-score').text(teams.teamsHome[i].score);
                $('#away-team-'+(i+1)+'-score').text(teams.teamsAway[i].score);
            }
        }
    });
}

function updatePoints(i, score_home, score_away, bet_home, bet_away) {
    $.ajax({
        url: '../functions/updatePoints.php',
        type: 'POST',
        data: {
            score_home: score_home,
            score_away: score_away,
            bet_home: bet_home,
            bet_away: bet_away
        },
        success: function(points) {
            var game = "#game-" + i + "-user-points";
            $(game).text(points);
        }
    });
}

function updateBets(currentUser, currentGameday) {
    $.ajax({
        url: '../functions/updateBets.php',
        type: 'POST',
        data: {currentGameday: currentGameday,
                currentUser: currentUser
        },
        success: function(response) {
            var bets = JSON.parse(response);
            
            for (var i = 0; i < bets.length; i++) {

                var target_home = document.getElementById('home-team-'+(i+1)+'-bet');
                var target_away = document.getElementById('away-team-'+(i+1)+'-bet');

                target_home.value = "";
                target_away.value = "";

                if(bets[i].bet_home && bets[i].bet_away){
                    target_home.value = bets[i].bet_home;
                    target_away.value = bets[i].bet_away;
                };
            };
        }
    });
}

function inputBets(currentUser, currentGameday, selectedGame, bet_home, bet_away) {
    $.ajax({
        url: '../functions/inputBets.php',
        type: 'POST',
        data: {
            currentUser: currentUser,
            currentGameday: currentGameday,
            selectedGame: selectedGame,
            bet_home: bet_home,
            bet_away:bet_away
        },
        success: function(response) {
            console.log(response);
        }
    });
}

function get_games(currentGameday, currentUser){
    var n_fixtures = 6;

    //Update fixtures to current gameday
    updateGameday(currentGameday, selectedDate);

    //Update bets to current gameday
    updateBets(currentUser, currentGameday);

    setTimeout(()=>{
        //Update scores to current gameday
        for (let i = 1; i <= n_fixtures; i++) {
            // Real scores
            var score_home = document.getElementById('home-team-'+i+'-score').textContent;
            var score_away = document.getElementById('away-team-'+i+'-score').textContent;

            // User bet
            var bet_home = document.getElementById('home-team-'+i+'-bet').value;
            var bet_away = document.getElementById('away-team-'+i+'-bet').value;
            updatePoints(i, score_home, score_away, bet_home, bet_away);
            
        };

    },100);
}


var currentUser = 1;


document.addEventListener("DOMContentLoaded", function() {

    //Get loged in user
    var userDataDiv = document.getElementById('userData');
    currentUser = userDataDiv.getAttribute('data-user-id');

    //Get chosen date
    var userDateDiv = document.getElementById('userDate');
    selectedDate = userDateDiv.getAttribute('chosenDate');

    get_games(1, currentUser);
    
    
});


$(document).ready(function() {

    //Variables
    var currentGameday = 1;
    var n_fixtures = 6;

    //Mutation Listener for changing gameday
    
    const callback_games = function() {
        currentGameday = this.value;

        get_games(currentGameday, currentUser);
    };

    var gameday_target = document.getElementById('gameday-dropdown');
    gameday_target.addEventListener('change', callback_games);
    

    //Games from API

    var callback_bets = function(){

        // Get target row
        var target_id = this.id;
        var position_target = target_id.charAt(10); // 'home-team-<X>-bet'

        // Real scores
        var score_home = document.getElementById('home-team-'+position_target+'-score').textContent;
        var score_away = document.getElementById('away-team-'+position_target+'-score').textContent;

        // User bet
        var bet_home = document.getElementById('home-team-'+position_target+'-bet').value;
        var bet_away = document.getElementById('away-team-'+position_target+'-bet').value;

        inputBets(currentUser, currentGameday, position_target, bet_home, bet_away);
        updatePoints(position_target, score_home, score_away, bet_home, bet_away);
    };

    var input_targets_home = []
    var input_targets_away = []

    for (let i = 1; i <= n_fixtures; i++) {
        input_targets_home[i] = document.getElementById('home-team-'+i+'-bet');
        input_targets_away[i] = document.getElementById('away-team-'+i+'-bet');
        input_targets_home[i].addEventListener('input', callback_bets);
        input_targets_away[i].addEventListener('input', callback_bets);
    }

    

});

