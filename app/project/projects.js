function getProjects(){
    return {
        "Websites": {
            "Lets-Freerun": {
                getDescription: function (){ return "Lets-Freerun is a website which gather a lot of parkour spots around the world."; },
                getLink: function(){ return "https://github.com/4m4Sec/Lets-Freerun"; },
                getSatetement: function (){ return "Under Development"; },
                getIcon: function (){ return "human"; }
            }
        },
        "Tools": {
            "Kharon": {
                getDescription: function (){ return "Kharon is an automated web-server ctf basic scan which perform basic tasks of webserver pentesting. Written in Python."; },
                getLink: function(){ return "https://github.com/4m4Sec/Kharon"; },
                getSatetement: function (){ return "Under Development"; },
                getIcon: function (){ return ""; }
            },
            "Theia": {
                getDescription: function (){ return "Theia is an ip-lookup OSINT tool for linux written in Python2."; },
                getLink: function(){ return "https://github.com/4m4Sec/Theia"; },
                getSatetement: function (){ return "Completed"; },
                getIcon: function (){ return ""; }
            },
        },
        "Others": {
            "ARS-SHELL-CRYPT": {
                getDescription: function (){ return "ARS-SHELL-CRYPT is a modified caesar's-cipher-based encrypt system written in C++."; },
                getLink: function(){ return "https://github.com/4m4Sec/ARS_SHELL_CRYPT"; },
                getSatetement: function (){ return "Completed"; },
                getIcon: function (){ return "lock"; }
            },
        }
    }
}