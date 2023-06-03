function getWriteups(){
    return {
        "bounty-hacker": {
            getName: function (){ return "Bounty Hacker"; },
            getLocation: function() { return "TryHackMe"; },
            getLink: function(){ return "thm/bounty-hacker/"; },
            getDifficulty: function (){ return "Easy" }
        },
        "simple-ctf": {
            getName: function (){ return "Simple CTF"; },
            getLocation: function() { return "TryHackMe"; },
            getLink: function(){ return "thm/simple-ctf/"; },
            getDifficulty: function (){ return "Easy" }
        },
        "ignite": {
            getName: function (){ return "Ignite"; },
            getLocation: function() { return "TryHackMe"; },
            getLink: function(){ return "thm/ignite/"; },
            getDifficulty: function (){ return "Easy" }
        }
    }
}