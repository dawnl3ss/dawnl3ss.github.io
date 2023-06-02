function getWriteups(){
    return {
        "bounty-hacker": {
            getLocation: function() { return "Try-Hack-Me"; },
            getLink: function(){ return "writeups/thm/bounty-hacker/"; },
            getDifficulty: function (){ return "Easy" }
        },
        "simple-ctf": {
            getLocation: function() { return "Try-Hack-Me"; },
            getLink: function(){ return "writeups/thm/simple-ctf/"; },
            getDifficulty: function (){ return "Easy" }
        },
        "ignite": {
            getLocation: function() { return "Try-Hack-Me"; },
            getLink: function(){ return "writeups/thm/ignite/"; },
            getDifficulty: function (){ return "Easy" }
        }
    }
}