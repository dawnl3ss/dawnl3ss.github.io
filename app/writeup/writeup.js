function getWriteups(){
    return {
        "wonderland": {
            getName: function (){ return "Wonderland"; },
            getLocation: function() { return "TryHackMe"; },
            getLink: function(){ return "thm/wonderland/"; },
            getDifficulty: function (){ return "Medium" },
            getDate: function (){ return "06/04/2023" }
        },
        "ignite": {
            getName: function (){ return "Ignite"; },
            getLocation: function() { return "TryHackMe"; },
            getLink: function(){ return "thm/ignite/"; },
            getDifficulty: function (){ return "Easy" },
            getDate: function (){ return "06/03/2023" }
        },
        "simple-ctf": {
            getName: function (){ return "Simple CTF"; },
            getLocation: function() { return "TryHackMe"; },
            getLink: function(){ return "thm/simple-ctf/"; },
            getDifficulty: function (){ return "Easy" },
            getDate: function (){ return "06/02/2023" }
        },
        "bounty-hacker": {
            getName: function (){ return "Bounty Hacker"; },
            getLocation: function() { return "TryHackMe"; },
            getLink: function(){ return "thm/bounty-hacker/"; },
            getDifficulty: function (){ return "Easy" },
            getDate: function (){ return "06/01/2023" }
        }
    }
}