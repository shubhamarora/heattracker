/**
 * Created by Shubham on 19-07-2015.
 */

$(document).ready(function() {

    /**
     * This method calculates the x coordinate of clicked
     * location w.r.t target element (which has actually
     * received click).
     *
     * @param event, event object
     * @returns {number} return x coordinate of clicked location w.r.t to target element
     */
    function getEventX(event) {
        // calculate target element position w.r.t document
        var elePosition = $(event.target).offset();
        var x  = event.pageX - elePosition.left;
        return x;
    }


    /**
     * This method calculates the y coordinate of clicked
     * location w.r.t target element (which has actually
     * received click).
     *
     * @param event, event object
     * @returns {number} return y coordinate of clicked location w.r.t to target element
     */
    function getEventY(event) {
        // calculate target element position w.r.t document
        var elePosition = $(event.target).offset();
        var y = event.pageY - elePosition.top;
        return y;
    }

    /**
     * This method calculates the css selector of the target
     * element (which has actually received click) and returns
     * the selector.
     *
     * @param ele, takes event object reference
     * @returns {selector} returns css selector of the target element
     */
    function getElementSelector(ele) {
        var selector, currentElement = ele;

        // Iterate until you reach document root.
        while (currentElement.length) {

            if(!currentElement[0].localName) break;

            // get tag name of current element
            var currentElementTagName = currentElement[0].localName.toLowerCase();

            // get children of current element parent (i.e. siblings of current element) with same tag name
            var siblings = currentElement.parent().children(currentElementTagName);

            // if siblings of same tag name are more than one
            // then, get the index position of the current element
            if (siblings.length > 1) {
                var allSiblings = currentElement.parent().children();
                var index = allSiblings.index(currentElement[0]) + 1;
                if (index > 1) {
                    currentElementTagName += ':nth-child(' + index + ')';
                }
            }

            selector = currentElementTagName + (selector ? '> ' + selector : '');
            currentElement = currentElement.parent();
        }

        return selector;
    }

    // Event Capturing
    var b = document.getElementsByTagName("body");
    b[0].addEventListener("click", function (event) {
        // get click event X and Y co-ordinates with respect to target element
        var clickEventX = getEventX(event);
        var clickEventY = getEventY(event);

        var ele = $(event.target);
        var eleSelector = getElementSelector(ele);
        var currentUrl = window.location.href;

        $.ajax({
            url:"server/collect.php?x="+clickEventX+"&y="+clickEventY+"&selector="+eleSelector+"&url="+currentUrl,
            type:"GET"
        });
    },true);

});