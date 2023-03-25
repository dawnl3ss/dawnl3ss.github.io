function getProjects(){
    return {
        "websites": {
            "Hardware-Hub": {
                getDescription: function (){ return "French discord server based on hardware, software and programming."; },
                getLink: function(){ return "http://hardware-hub.fr/"; },
                getSatetement: function (){ return "Under Development"; },
                getIcon: function (){ return "laptop"; }
            },
            "Lets-Freerun": {
                getDescription: function (){ return "website which gather a lot of parkour spots around the world."; },
                getLink: function(){ return "https://github.com/4m4Sec/Lets-Freerun"; },
                getSatetement: function (){ return "Under Development"; },
                getIcon: function (){ return "human"; }
            }
        },
        "tools": {
            "Kharon": {
                getDescription: function (){ return "automated ctf web-server scan which perform basic tasks of webserver pentesting."; },
                getLink: function (){ return "https://github.com/4m4Sec/Kharon"; },
                getSatetement: function (){ return "Under Development"; },
                getIcon: function (){ return "skull"; }
            },
            "Theia": {
                getDescription: function (){ return "ip-lookup OSINT tool for linux."; },
                getLink: function (){ return "https://github.com/4m4Sec/Theia"; },
                getSatetement: function (){ return "Completed"; },
                getIcon: function (){ return "search-web"; }
            },
        },
        "others": {
            "ARS-ENCRYPT": {
                getDescription: function (){ return "modified caesar's-cipher-based encrypt system written in C++."; },
                getLink: function(){ return "https://github.com/4m4Sec/ARS_ENCRYPT"; },
                getSatetement: function (){ return "Completed"; },
                getIcon: function (){ return "lock"; }
            },
            "Zephyr": {
                getDescription: function (){ return "web router written in PHP 7.4."; },
                getLink: function(){ return "https://github.com/4m4Sec/Zephyr"; },
                getSatetement: function (){ return "Completed"; },
                getIcon: function (){ return "directions"; }
            }
        }
    }
}