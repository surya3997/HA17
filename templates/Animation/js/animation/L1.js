/**
 * Function to check if the browser is that of a mobile phone.
 * This should stop the user from playing anything.
 * TODO Bring a super big div and cover everything up :D
 */
function IsMobileBrowser() {
    var check = false;
    (function(a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
};

if (IsMobileBrowser()) {
    window.location = 'mobilenotallowed.php';
}

var mFW = new AnimationFramework();

var page1 = new AnimationPage(1, mFW);
var page1Story = new AnimationPage(2, mFW);
var page2 = new AnimationPage(3, mFW);
var page2Story = new AnimationPage(4, mFW);
var page3 = new AnimationPage(5, mFW);
var page4 = new AnimationPage(6, mFW);
var page5 = new AnimationPage(7, mFW);


page1Story.SetAnimations([{
        element: 'ha-anim-heroine-speech-container',
        timeSpan: 0.5,
        originalPos: {}, //Will be filled on runtime
        initPos: { //Optional. Same position it is currently in.
            x: EnumScreenLocation.RIGHT_OFFSCREEN,
            y: '-=190'
        },
        animatedPos: {
            x: '0%',
            y: '-=190'
        },
        hideLocation: EnumAnimationHide.RIGHT_HIDE,
        storyMode: "Becoming the richest man in the world doesn't seem impossible...But I need some one to deafeat my competitors!!!",
        storyTeller: "Heroine"
    },
    {
        element: 'millionaire',
        timeSpan: 1,
        originalPos: {}, //Will be filled on runtime
        initPos: { //Optional. Same position it is currently in.
            x: EnumScreenLocation.RIGHT_OFFSCREEN,
            y: '-=250'
        },
        animatedPos: {
            x: '80%',
            y: '-=250'
        },
        hideLocation: EnumAnimationHide.RIGHT_HIDE
    },
    {
        element: 'hacker',
        timeSpan: 1,
        originalPos: {}, //Will be filled on runtime
        initPos: { //Optional. Same position it is currently in.
            x: EnumScreenLocation.LEFT_OFFSCREEN,
            y: '-=250'
        },
        animatedPos: {
            x: '10%',
            y: '-=250'
        },
        initDelay: 10,
        hideLocation: EnumAnimationHide.LEFT_HIDE
    }
]);

page2.SetAnimations([{
        element: 'ha-anim-hero-speech-container',
        timeSpan: 0.5,
        originalPos: {}, //Will be filled on runtime
        initPos: { //Optional. Same position it is currently in.
            x: EnumScreenLocation.RIGHT_OFFSCREEN,
            y: '-=190'
        },
        animatedPos: {
            x: '0%',
            y: '-=190'
        },
        hideLocation: EnumAnimationHide.RIGHT_HIDE,
        storyMode: "I've hacked through many systems globally. Do you have any work for me??",
        storyTeller: "Hero"
    },
    {
        element: 'hacker',
        timeSpan: 1,
        originalPos: {}, //Will be filled on runtime
        animatedPos: {
            x: '10%',
            y: '-=250'
        },
        hideLocation: EnumAnimationHide.LEFT_HIDE
    },
    {
        element: 'millionaire',
        timeSpan: 1,
        originalPos: {}, //Will be filled on runtime
        animatedPos: {
            x: '80%',
            y: '-=250'
        },
        hideLocation: EnumAnimationHide.RIGHT_HIDE
    }
]);
page2Story.SetAnimations([{
        element: 'ha-anim-heroine-speech-container',
        timeSpan: 1,
        originalPos: {}, //Will be filled on runtime
        initPos: { //Optional. Same position it is currently in.
            x: EnumScreenLocation.RIGHT_OFFSCREEN,
            y: '-=190'
        },
        animatedPos: {
            x: '0%',
            y: '-=190'
        },
        hideLocation: EnumAnimationHide.RIGHT_HIDE,
        storyMode: "I want you to exploit the systems of my competitors and crash them.I can fix a deal of certain cryptocurrencies!",
        storyTeller: "Heroine"
    },
    {
        element: 'hacker',
        timeSpan: 2,
        originalPos: {}, //Will be filled on runtime
        animatedPos: {
            x: '10%',
            y: '-=250'
        }
        //,        hideLocation: EnumAnimationHide.LEFT_HIDE
    },
    {
        element: 'millionaire',
        timeSpan: 2,
        originalPos: {}, //Will be filled on runtime
        animatedPos: {
            x: '80%',
            y: '-=250'
        }
        //,hideLocation: EnumAnimationHide.TOP_HIDE
    }
]);

page3.SetAnimations([{
    element: 'ha-anim-hero-speech-container',
    timeSpan: 1,
    originalPos: {}, //Will be filled on runtime
    initPos: { //Optional. Same position it is currently in.
        x: EnumScreenLocation.RIGHT_OFFSCREEN,
        y: '-=190'
    },
    animatedPos: {
        x: 'EnumScreenLocation.RIGHT_OFFSCREEN,',
        y: '-=190'
    },
    hideLocation: EnumAnimationHide.RIGHT_HIDE,
    storyMode: "Share the locations of them to my phone. Let me know your plan then!!",
    storyTeller: "Hero"
}]);


page4.SetAnimations([{
    element: 'ha-anim-heroine-speech-container',
    timeSpan: 1,
    originalPos: {}, //Will be filled on runtime
    initPos: { //Optional. Same position it is currently in.
        x: EnumScreenLocation.RIGHT_OFFSCREEN,
        y: '-=190'
    },
    animatedPos: {
        x: '0%',
        y: '-=190'
    },
    hideLocation: EnumAnimationHide.RIGHT_HIDE,
    storyMode: "If you complete a task successfully,then credit will be added to your account..",
    storyTeller: "Heroine"
}]);

/* page4Story.SetAnimations([{
    element: 'ha-anim-heroine-speech-container',
    timeSpan: 1,
    originalPos: {}, //Will be filled on runtime
    initPos: { //Optional. Same position it is currently in.
        x: EnumScreenLocation.RIGHT_OFFSCREEN,
        y: '-=190'
    },
    animatedPos: {
        x: '0%',
        y: '-=190'
    },
    hideLocation: EnumAnimationHide.RIGHT_HIDE,
    storyMode: "I'll make an initial transaction to your crypto-currency wallet. Take care of the travel expenses.",
    storyTeller: "Heroine"
}]); */

page5.SetAnimations([{
    element: 'ha-anim-hero-speech-container',
    timeSpan: 1,
    originalPos: {}, //Will be filled on runtime
    initPos: { //Optional. Same position it is currently in.
        x: EnumScreenLocation.RIGHT_OFFSCREEN,
        y: '-=190'
    },
    animatedPos: {
        x: '0%',
        y: '-=190'
    },
    hideLocation: EnumAnimationHide.RIGHT_HIDE,
    storyMode: "No worry!!Deal is fixed... We'll communicate through a secret messaging app. Let the cyberwar begin!!",
    storyTeller: "Hero"
}]);

mFW.SetAnimationResources([{
        id: 'building_1',
        src: 'res/animation_images/city3.jpg',
        width: '100%',
        height: '100%'
    },
    {
        id: 'hero_speech',
        src: 'res/animation_images/Hero_Speech.png',
        width: '100%',
        height: '220px'
    },
    {
        id: 'ha-anim-hero-speech-container',
        mode: 'div'
    },
    {
        id: 'ha-anim-heroine-speech-container',
        mode: 'div'
    },
    {
        id: 'hacker',
        src: 'res/final/hacker_alpha.png',
        width: '200px',
        height: '250px'
    },
    {
        id: 'millionaire',
        src: 'res/final/millionaire_alpha.png',
        width: '200px',
        height: '250px'
    }
]);

mFW.SetAnimationTargetDOM('animationBody');
mFW.AddAnimationPage(page1);
mFW.AddAnimationPage(page1Story);
mFW.AddAnimationPage(page2);
mFW.AddAnimationPage(page2Story);
mFW.AddAnimationPage(page3);
mFW.AddAnimationPage(page4);
mFW.AddAnimationPage(page5);
mFW.InitAnimationSequence();