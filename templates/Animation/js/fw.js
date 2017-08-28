/**
 * Animation framework.
 * Author : Deltatiger
 * Changes:
 * 1. Base framework.
 */

/**
 * This is to mention the direction of the screen to keep the image or move the image to.
 */
var EnumScreenLocation = Object.freeze({
    LEFT_OFFSCREEN: 'LEFT_OFFSCREEN',
    RIGHT_OFFSCREEN: 'RIGHT_OFFSCREEN',
    TOP_OFFSCREEN: 'TOP_OFFSCREEN',
    BOTTOM_OFFSCREEN: 'BOTTOM_OFFSCREEN'
});

/**
 * Enumeration for Direction of Hiding
 */
var EnumAnimationHide = Object.freeze({
    LEFT_HIDE: 'LEFT_HIDE',
    RIGHT_HIDE: 'RIGHT_HIDE',
    TOP_HIDE: 'TOP_HIDE',
    BOTTOM_HIDE: 'BOTTOM_HIDE',
    NO_HIDE: 'NO_HIDE'
});

/**
 * Orchestrator class.
 * Co-ordinates between the ResourceLoader and the AnimatonPage objects
 */
class AnimationFramework {
    constructor(sliderDiv) {
        this.mAnimationPageList = new Array();
        this.mCurrentPage = AnimationFramework.StartPage;
        this.mSliderDiv = sliderDiv;
    }
}

/**
 * A Constant for denoting that the story is yet to start.
 */
AnimationFramework.StartPage = -1;
AnimationFramework.EndPage = -2; /* Will be changed once animation is started */

/**
 * Method for adding pages to the AnimationFramework
 */
AnimationFramework.prototype.AddAnimationPage = function(animationPage) {
    this.mAnimationPageList.push(animationPage);
}

/**
 * Method for setting the Animation Resources need for the entire sequence. 
 * This is loaded once the signal is given.
 */
AnimationFramework.prototype.SetAnimationResources = function(res) {
    this.mAnimationRes = res;
}

/**
 * Method for setting the div in which the animation should take place.
 */
AnimationFramework.prototype.SetAnimationTargetDOM = function(targetDOM) {
    this.mAnimationTargetDOM = targetDOM;
}

/**
 * Method to load and start the animation.
 * Starts with loading the image and then begins the first animation page based on Callbacks
 */
AnimationFramework.prototype.InitAnimationSequence = function() {
    AnimationFramework.EndPage = this.mAnimationPageList.length;
    this.mMainResLoader = new ResourceLoader(this.mAnimationTargetDOM);
    this.PrepareSlider();
    this.mMainResLoader.SetAnimationFramework(this);
    this.mMainResLoader.LoadElements(this.mAnimationRes);
}

/**
 * Callback that will start the animation process after loading the items into DOM
 */
AnimationFramework.prototype.StartAnimation = function() {
    //Init the first page in the AnimationPageList
    this.mCurrentPage = 0; //Initial transition is a manual transition.
    if (this.mAnimationPageList[this.mCurrentPage] != undefined) {
        this.mAnimationPageList[this.mCurrentPage].PlaceResoureceInitPos();
        this.mAnimationPageList[this.mCurrentPage].ShowAnimation();
    }
}

function GetCurrentLevelId() {
    var returnMsg = new Array();
    if (window.location.pathname.indexOf('index.php') == -1) {
        var levelStart = window.location.search.indexOf('level=') + 6;
        if (levelStart == -1) {
            alert('Invalid location. Rerouting packets. Please hold.');
            window.location = 'index.php';
        }
        var levelEnd = window.location.search.indexOf('&', levelStart);
        if (levelEnd == -1) { //This is the last parameter. Keep the end as the end of the string
            levelEnd = window.location.search.length;
        }
        returnMsg['level'] = window.location.search.substr(levelStart, (levelEnd - levelStart));
    }
    return returnMsg;
}

/**
 * Method for moving the animation to the next page.
 */
AnimationFramework.prototype.NextPage = function() {
    //Handle the first page properly.
    if (this.mCurrentPage == AnimationFramework.StartPage) {
        //We show the first animation.
        this.mCurrentPage = 0;
        this.mAnimationPageList[this.mCurrentPage].PlaceResoureceInitPos();
        this.mAnimationPageList[this.mCurrentPage].ShowAnimation();
    } else {
        //First hide the elements in the current page.
        if (this.mAnimationPageList[this.mCurrentPage] != undefined) {
            this.mAnimationPageList[this.mCurrentPage].HideAnimation();
        }
        //This has to be done once all the animations are over.
        //TODO Sync up here.
        if (this.mCurrentPage == (this.mAnimationPageList.length)) {
            //No more pages to load. 
            //TODO Come up with a better way to tell the story. Prompt for level entry.
            console.log('Reached the end of the story.');
            this.mCurrentPage = AnimationFramework.EndPage;
            //TODO This is to redirect the user to the level page.
            window.location = 'level.php?level=' + GetCurrentLevelId()['level'];
            return;
        }
        this.mCurrentPage += 1;
        if (this.mAnimationPageList[this.mCurrentPage] != undefined) {
            this.mAnimationPageList[this.mCurrentPage].PlaceResoureceInitPos();
            this.mAnimationPageList[this.mCurrentPage].ShowAnimation();
        }
    }
    this.UpdateSliderButton(this.mCurrentPage - 1);
}

/**
 * Method for moving the pages back.
 */
AnimationFramework.prototype.PreviousPage = function() {
    //This is to handle the last page transition
    if (this.mCurrentPage == AnimationFramework.EndPage) {
        this.mCurrentPage = AnimationFramework.EndPage - 1;
        this.mAnimationPageList[this.mCurrentPage].ShowAnimation();
    } else {
        //Hide the current page.
        this.mAnimationPageList[this.mCurrentPage].BackwardHideAnimation();
        //Show the previous page.
        if (this.mCurrentPage < 0) {
            //No more pages to load. 
            //TODO Come up with a better way to tell the story. Prompt for level entry.
            console.log('Reached the start of the story.');
            return;
        }
        this.mCurrentPage -= 1;
        if (this.mAnimationPageList[this.mCurrentPage] != undefined) {
            this.mAnimationPageList[this.mCurrentPage].PlaceResoureceInitPos();
            this.mAnimationPageList[this.mCurrentPage].ShowAnimation();
        }
    }
    this.UpdateSliderButton(this.mCurrentPage + 1);
}

/**
 * Method to update the animation slider.
 * Remove the selected id from the current page and add it to the next page.
 */
AnimationFramework.prototype.UpdateSliderButton = function(prevPage) {
    $('#ha_anim_slider_page_' + prevPage).removeClass('ha_anim_slider_selected');
    $('#ha_anim_slider_page_' + this.mCurrentPage).addClass('ha_anim_slider_selected');
}

/**
 * Get the original Position from the ResourceLoader object.
 */
AnimationFramework.prototype.GetResInitLocation = function(objectID) {
    return this.mMainResLoader.GetResInitLocation(objectID);
}

/**
 * This is used to prepare the slider for a proper navigation system during animation.
 */
AnimationFramework.prototype.PrepareSlider = function() {
    //Set the width
    var totalWidth = 30 * this.mAnimationPageList.length + 70;
    $('#ha_anim_slider_container').css('width', 290);
    $('#ha_anim_slider_hiding').css('width', totalWidth);
    //Add the various number of pages
    for (var pageIter = 0; pageIter < this.mAnimationPageList.length; pageIter++) {
        var newPageNode = document.createElement("div");
        newPageNode.setAttribute("class", "ha_anim_slider_page");
        newPageNode.setAttribute("id", 'ha_anim_slider_page_' + pageIter);
        document.getElementById('ha-anim-slider-pages').appendChild(newPageNode);
    }
    //Set it to the current page.
    $('#ha_anim_slider_page_0').addClass('ha_anim_slider_selected');
    //Place this properly.
    $('#ha_anim_slider_container').css('left', (AnimationPage.mDocWidth - totalWidth) / 2);
    $('#ha_anim_slider_hiding').css('left', (AnimationPage.mDocWidth - totalWidth) / 2);
    //Create the even handlers for changing the page.
    var self = this;
    $('#ha-anim-slider-leftnav').on('click', function() {
        self.PreviousPage();
    });
    $('#ha-anim-slider-rightnav').on('click', function() {
        self.NextPage();
    });
}

/**
 * Class responsible for loading all the images into memory.
 * Initiates the animation once the images have been fully loaded.
 */
class ResourceLoader {
    /**
     * Constructor that accepts the base frame to which all elements have to be added into.
     */
    constructor(sourceFrameDOM) {
        this.mSourceFrame = sourceFrameDOM;
        this.mNumResources = 0;
        this.mResOriginalLocation = new Map();
        this.mAnimationFramework
    }
}

/**
 * Method to set the callback once the animations have all been loaded.
 */
ResourceLoader.prototype.SetAnimationFramework = function(animationFramework) {
    this.mAnimationFramework = animationFramework;
}

/**
 * Method for specifying the elements to load on screen.
 */
ResourceLoader.prototype.LoadElements = function(elementList) {
    //We add all elements to the root of body.
    var docHolder = document.getElementById(this.mSourceFrame);
    this.mNumResources = elementList.length;
    //Add all elements as img tags with id as specified.
    for (var elemIter = 0; elemIter < elementList.length; elemIter++) {
        //Get the current element
        var cElement = elementList[elemIter];
        if (cElement.mode != undefined && cElement.mode == 'div') {
            //We just have to get the reference. No need to create the divs
            this.mResOriginalLocation[cElement.id] = $('#' + cElement.id).position();
            this.mNumResources -= 1;
        } else {
            var newResource = document.createElement("img");
            //Add the required attributes.
            newResource.setAttribute("src", cElement.src);
            newResource.setAttribute("id", cElement.id);
            newResource.setAttribute("class", "low-z-index");
            if (cElement.width != undefined) {
                newResource.setAttribute("width", cElement.width);
            }
            if (cElement.height != undefined) {
                newResource.setAttribute("height", cElement.height);
            }
            docHolder.appendChild(newResource);
            this.mResOriginalLocation[cElement.id] = '';
            var thisObj = this;
            newResource.onload = function() {
                thisObj.CompleteOneImageLoad($(this).attr('id'));
            };
        }
    }
}

/**
 * Used to signal the framework that an image has been loaded.
 */
ResourceLoader.prototype.CompleteOneImageLoad = function(elementID) {
    this.mNumResources -= 1;
    //Set it up in the Array
    this.mResOriginalLocation[elementID] = $('#' + elementID).position();
    if (this.mNumResources == 0) {
        //Start the animation show.
        this.mAnimationFramework.StartAnimation();
    }
}

/**
 * This gets the resources' original location from the stored data.
 */
ResourceLoader.prototype.GetResInitLocation = function(elementID) {
    return this.mResOriginalLocation[elementID];
}

/**
 * Contains the animation details required for one particular page.
 */
class AnimationPage {
    constructor(pageNumber, animationFramework) {
        this.mPageNumber = pageNumber;
        this.mAnimationFramework = animationFramework;
        this.mExtraHideAnimations = undefined;
        this.mNumAnimationsCompleted = 0;
    }
}

/**
 * This method is used to add animation of the items used in the Page..
 * Elements are of the form :
 * TODO Redo the format over here.
 */
AnimationPage.prototype.SetAnimations = function(animationList) {
    this.mElementList = animationList;
}

/**
 * These extra hide are elements that were shown in previous pages and left behind to support this page.
 * These can be directly accessed and hidden using the ID
 */
AnimationPage.prototype.SetExtraHideAnimations = function(extraHideList) {
    this.mExtraHideAnimations = extraHideList;
}

/**
 * This method is used to perform the initial placement of the objects.
 * This should be called once the objects are fully loaded by the ResourceLoader
 */
AnimationPage.prototype.PlaceResoureceInitPos = function() {
    //Move all the elements to their required co-ordinates
    if (this.mElementList == undefined) { //Nothing to place in this iteration.
        return;
    }
    var elementCount = this.mElementList.length;
    for (var elemIter = 0; elemIter < elementCount; elemIter++) {
        var elemAnimation = this.mElementList[elemIter];
        //We always need to get the original position for use in the future
        var itemPosition = this.mAnimationFramework.GetResInitLocation(elemAnimation.element);
        elemAnimation.originalPos = { x: itemPosition.left, y: itemPosition.top };

        if (elemAnimation.initPos == undefined) { //Skip any placement since this image is used from previous div.
            continue;
        }

        //Move the items to the specified position
        var elementSelector = document.getElementById(elemAnimation.element);
        //Change the coords to relative translations   
        var initPosAbsCoords = this.CalculateOffscreenLocations('#' + elemAnimation.element, elemAnimation.initPos);
        var initPos = this.ConvertAbsPosToTranslation(elemAnimation.originalPos, initPosAbsCoords);
        TweenMax.to(elementSelector, 0, initPos);
    }
}

/**
 * Method to covert from 25% to 0.25
 */
AnimationPage.prototype.ConvertPercentageStrToDouble = function(percentage) {
    var percentInt = parseInt(percentage.substr(0, percentage.indexOf('%')));
    return percentInt / 100.0;
}

/**
 * Method to convert percentage to pixel coordinates. Converts directly to relative translation.
 * We only deal with pixels since backward animation is also required.
 * Returns data in the form {x : <X>, y : <Y>}
 */
AnimationPage.prototype.ConvertPercentageToPixels = function(percentageCoords) {
    var returnValue = {
        x: 0,
        y: 0
    };
    //Check which of the following is set.
    if (percentageCoords.x != undefined) {
        returnValue.x = Math.round(AnimationPage.mDocWidth * this.ConvertPercentageStrToDouble(percentageCoords.x));
    }
    if (percentageCoords.y != undefined) {
        returnValue.y = Math.round(AnimationPage.mDocHeight * this.ConvertPercentageStrToDouble(percentageCoords.y));
    }
    return returnValue;
}

/**
 * TweenMax (CSS Transform) are calculating the translate relatively. We need to do it absolute position wise.
 * This method will provide the relative transform required to go to that absolute position.
 */
AnimationPage.prototype.ConvertAbsPosToTranslation = function(originalPos, reqPos) {
    //This is the relative motion from the given position
    return { x: (reqPos.x - originalPos.x), y: (reqPos.y - originalPos.y) };
}

/**
 * Method to process the string co-ordinates
 */
AnimationPage.prototype.ProcessStringCoords = function(coord, direction) {
    if (typeof coord != 'string') { //Non string argument
        return coord;
    }
    if (coord.indexOf('%') != -1) {
        var givenValue = new Map();
        givenValue[direction] = coord;
        return this.ConvertPercentageToPixels(givenValue)[direction];
    }
    if (coord.indexOf('-=') != -1) {
        /**
         * This is used as follows.
         * -250 in x direction is considered as : TotalWidth - 250.
         */
        var offset = parseInt(coord.substr(2));
        var retValue = 0;
        if (direction == 'x') {
            retValue = AnimationPage.mDocWidth - offset;
        } else {
            retValue = AnimationPage.mDocHeight - offset;
        }
        return retValue;
    }
    //These are plain static coordinates that must be followed.
    return parseInt(coord);
}

/**
 * Gives the location of the Offscreen locations 
 */
AnimationPage.prototype.CalculateOffscreenLocations = function(element, givenCoords) {
    var baseX = 0;
    var baseY = 0;
    //Check the X Coordinates of the system.
    if (givenCoords.x == EnumScreenLocation.RIGHT_OFFSCREEN) {
        baseX = AnimationPage.mDocWidth;
    } else if (givenCoords.x == EnumScreenLocation.LEFT_OFFSCREEN) {
        baseX = -($(element).width());
    } else {
        //This could be a normal co-ordinate
        if (typeof givenCoords.x == 'string') {
            baseX = this.ProcessStringCoords(givenCoords.x, 'x');
        } else {
            baseX = givenCoords.x;
        }
    }
    //Check the Y Coordinates of the system.
    if (givenCoords.y == EnumScreenLocation.BOTTOM_OFFSCREEN) {
        baseY = AnimationPage.mDocHeight;
    } else if (givenCoords.y == EnumScreenLocation.TOP_OFFSCREEN) {
        baseY = -($(element).height());
    } else {
        //This could be a normal co-ordinate
        if (typeof givenCoords.y == 'string') {
            baseY = this.ProcessStringCoords(givenCoords.y, 'y');
        } else {
            baseY = givenCoords.y;
        }
    }
    return { x: baseX, y: baseY };
}

/**
 * Method to count the number of animations that have been completed.
 */
AnimationPage.prototype.CompleteSingleAnimation = function() {
    this.mNumAnimationsCompleted -= 1;
    if (this.mNumAnimationsCompleted == 0) {
        //Remove the thing hiding the anim navigation bar.

    }
}

/**
 * This method is used to Move the animation from right to left.
 * Speed is given as a value between 1 - 5 as a modifier to the existing speed.
 */
AnimationPage.prototype.ShowAnimation = function(speed) {
    //Default Argument fix
    if (speed == undefined) {
        speed = 1;
    }
    if (this.mElementList == undefined) { //Nothing to place in this page.
        return;
    }
    var elementCount = this.mElementList.length;
    this.mNumAnimationsCompleted = elementCount;
    for (var elemIter = 0; elemIter < elementCount; elemIter++) {
        var elemAnimation = this.mElementList[elemIter];
        var animatedPosLoc = {
            x: 0,
            y: 0
        };
        animatedPosLoc.x = this.ProcessStringCoords(elemAnimation.animatedPos.x, 'x');
        animatedPosLoc.y = this.ProcessStringCoords(elemAnimation.animatedPos.y, 'y');
        //Calculte the required position to translation from the originalPos
        animatedPosLoc = this.ConvertAbsPosToTranslation(elemAnimation.originalPos, animatedPosLoc);
        //This is to make additions in the future
        var argsMap = new Map();
        argsMap.css = animatedPosLoc;
        //Check if we have a delay
        if (elemAnimation.initDelay != undefined) {
            argsMap.delay = elemAnimation.initDelay;
        }
        if (elemAnimation.storyMode != undefined) {
            var self = this;
            var storyAnimation = elemAnimation;
            argsMap.onComplete = function() {
                //Show the required div.
                self.TellStory(storyAnimation.storyTeller, storyAnimation.storyMode);
                self.CompleteSingleAnimation();
            }
        }
        TweenMax.to(document.getElementById(elemAnimation.element), elemAnimation.timeSpan * speed, argsMap);
    }
}

/**
 * This is used to invoke the typed library to tell the story.
 */
AnimationPage.prototype.TellStory = function(storyTeller, storyMessage) {
    /* $('#ha-anim-hero-speech').css({visibility: 'visible'}); */
    if (storyTeller.localeCompare("Hero") == 0) {
        console.log('hero');
        $('#ha-anim-hero-speech').animate({ opacity: 1 }, 200);
        //Start the typed thingy
        $('#ha-anim-speech-typed').typed({
            strings: [storyMessage],
            typeSpeed: 20,
            backDelay: 500,
            loop: false,
            loopCount: false
        });
    } else {
        console.log('heroine');
        $('#ha-anim-heroine-speech').animate({ opacity: 1 }, 200);
        //Start the typed thingy
        $('#ha-anim-heroine-speech-typed').typed({
            strings: [storyMessage],
            typeSpeed: 20,
            backDelay: 500,
            loop: false,
            loopCount: false
        });
    }
    /* $('#ha-anim-hero-speech').fadeIn("slow"); */

}

/**
 * This method is used to Move the animation from left to right.
 * Speed is given as a value between 1 - 5 as a modifier to the existing speed.
 * This is for forward animation.
 */
AnimationPage.prototype.HideAnimation = function(speed) {
    //Default Argument Fix
    if (speed == undefined) {
        speed = 1;
    }
    if (this.mElementList == undefined) {
        return;
    }
    var elementCount = this.mElementList.length;
    for (var elemIter = 0; elemIter < elementCount; elemIter++) {
        //Change all locations to extreme ends
        var elemAnimation = this.mElementList[elemIter];
        if (elemAnimation.hideLocation == undefined || elemAnimation.hideLocation == EnumAnimationHide.NO_HIDE) {
            //No need for a hide animation for this element. Need in the next page
            continue;
        }
        //Check if the hide is along the X Axis
        var hideLocation = { x: 0, y: 0 };
        if (elemAnimation.hideLocation == EnumAnimationHide.LEFT_HIDE) {
            hideLocation.x = EnumScreenLocation.LEFT_OFFSCREEN;
            hideLocation.y = elemAnimation.animatedPos.y;
        } else if (elemAnimation.hideLocation == EnumAnimationHide.RIGHT_HIDE) {
            hideLocation.x = EnumScreenLocation.RIGHT_OFFSCREEN;
            hideLocation.y = elemAnimation.animatedPos.y;
        } else if (elemAnimation.hideLocation == EnumAnimationHide.TOP_HIDE) {
            hideLocation.x = elemAnimation.animatedPos.x;
            hideLocation.y = EnumScreenLocation.TOP_OFFSCREEN;
        } else if (elemAnimation.hideLocation == EnumAnimationHide.BOTTOM_HIDE) {
            hideLocation.x = elemAnimation.animatedPos.x;
            hideLocation.y = EnumScreenLocation.BOTTOM_OFFSCREEN;
        }
        var newLocation = this.CalculateOffscreenLocations('#' + elemAnimation.element, hideLocation);
        //Get the new translation
        var initPos = this.ConvertAbsPosToTranslation(elemAnimation.originalPos, newLocation);
        TweenMax.to(document.getElementById(elemAnimation.element), elemAnimation.timeSpan / speed, initPos);
        //Hide the story telling if it was there in this animation object 
        if (elemAnimation.storyMode != undefined) {
            /* $('#ha-anim-hero-speech').css({visibility: 'hidden'}); */
            $('#ha-anim-hero-speech').animate({ opacity: 0 }, 300);
        }
    }
    //Check for extra hide. These are elements that were brought up in the previous pages but remained to support this page
    if (this.mExtraHideAnimations != undefined) {
        this.HideExtraElements();
    }
}

/**
 * Method to perform the backward animation.
 * This is used when going to the previous page.
 */
AnimationPage.prototype.BackwardHideAnimation = function() {
    //Move everything to the initPos.
    var speed = 0.5;
    if (this.mElementList == undefined) {
        return;
    }
    var elementCount = this.mElementList.length;
    for (var elemIter = 0; elemIter < elementCount; elemIter++) {
        //Change all locations to extreme ends
        var elemAnimation = this.mElementList[elemIter];
        if (elemAnimation.initPos == undefined) {
            //No need for a hide animation for this element. Need in the next page
            continue;
        }
        var newLocation = this.CalculateOffscreenLocations('#' + elemAnimation.element, elemAnimation.initPos);
        //Get the new translation
        var initPos = this.ConvertAbsPosToTranslation(elemAnimation.originalPos, newLocation);
        TweenMax.to(document.getElementById(elemAnimation.element), elemAnimation.timeSpan / speed, initPos);
        //Hide the story telling if it was there in this animation object 
        if (elemAnimation.storyMode != undefined) {
            /* $('#ha-anim-hero-speech').css({visibility: 'hidden'}); */
            $('#ha-anim-hero-speech').animate({ opacity: 0 }, 300);
        }
    }
}

/**
 * Method used to hide the extra elements in the page.
 * TODO Complete this if required
 */
AnimationPage.prototype.HideExtraElements = function() {
    var extraElemCount = this.mExtraHideAnimations.length;
    for (var extraIter = 0; extraIter < extraElemCount; extraIter++) {
        var elemToHide = this.mExtraHideAnimations[extraIter];
        if (elemToHide.hideLocation == EnumAnimationHide.LEFT_HIDE) {
            hideLocation.x = EnumScreenLocation.LEFT_OFFSCREEN;
            hideLocation.y = elemAnimation.animatedPos.y;
        } else if (elemToHide.hideLocation == EnumAnimationHide.RIGHT_HIDE) {
            hideLocation.x = EnumScreenLocation.RIGHT_OFFSCREEN;
            hideLocation.y = elemAnimation.animatedPos.y;
        } else if (elemToHide.hideLocation == EnumAnimationHide.TOP_HIDE) {
            hideLocation.x = elemAnimation.animatedPos.x;
            hideLocation.y = EnumScreenLocation.TOP_OFFSCREEN;
        } else if (elemToHide.hideLocation == EnumAnimationHide.BOTTOM_HIDE) {
            hideLocation.x = elemAnimation.animatedPos.x;
            hideLocation.y = EnumScreenLocation.BOTTOM_OFFSCREEN;
        }
        TweenMax.to();
    }
}

/**
 * These are some static variables that will be used for computing co-ordinates.
 */
AnimationPage.mDocWidth = $(document).width();
AnimationPage.mDocHeight = $(document).height();