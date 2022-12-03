let inputs = [];

/**
 * Run any function on ready state of app
 * @param {function} fn callback
 */
function ready(fn) {
    if (document.readyState !== "loading") {
        fn();
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

/**
 * Initial regex for .only-letters selector
 */
 function onlyLetters() {
    initOnly(".only-letters", /^[a-z\s]+$/i);
}

/**
 * Initial regex for .only-digits selector
 */
 function onlyNumbers() {
    initOnly(".only-digits", /^\d*$/);
}

/**
 * Initial regex for .only-email selector
 */
function onlyEmail() {
    initOnly(".only-email", /^[a-zA-Z_0-9\.\-@]*$/);
}

/**
 * Initial regex for .only-no-spaces selector
 */
function onlyNoSpaces() {
    initOnly(".only-no-spaces", /^\S*$/);
}

/**
 * Prevent paste or drop event for .only-no-paste selector
 */
 function onlyNoPaste() {
    document.querySelectorAll("only-no-paste").forEach((element) => {
        element.addEventListener("paste", (e) => e.preventDefault());
        element.addEventListener("drop", (e) => e.preventDefault());
    });
}

/**
 * Add callback to any event for element
 * @param {Event} e event
 * @param {Element} querySelector document element
 * @param {Function} callback function on event
 */
 function addEventUtil(e, querySelector, callback) {
    document.querySelector("body").addEventListener(
        e,
        (evt) => {
            let targetElement = evt.target;
            while (targetElement != null) {
                if (targetElement.matches(querySelector)) {
                    callback(evt);
                    return;
                }
                targetElement = targetElement.parentElement;
            }
        },
        true
    );
}

/**
 * Listen event for element
 * @param {Event} event event
 * @param {Element} querySelector document element
 * @param {Function} callback function on event
 */
function onEvent(event, querySelector, callback) {
    if (Array.isArray(event)) {
        event.forEach((e) => {
            addEventUtil(e, querySelector, callback);
        });
    } else {
        addEventUtil(event, querySelector, callback);
    }
}


/**
 * Initial run Only regex definitions
 * @param {Element} element
 * @param {RegExp} regex
 */
 function initOnly(element = "", regex = null) {
    onEvent(
        [
            "input",
            "keydown",
            "keyup",
            "mousedown",
            "mouseup",
            "select",
            "contextmenu",
            "drop",
        ],
        element,
        (el) => {
            el = el.target;

            if (regex.test(el.value)) {
                el.oldValue = el.value.replace(/(<([^>]+)>)/gi, "");
                el.oldSelectionStart = el.selectionStart;
                el.oldSelectionEnd = el.selectionEnd;
            } else if (el.hasOwnProperty("oldValue")) {
                el.value = el.oldValue.replace(/(<([^>]+)>)/gi, "");
                el.setSelectionRange(el.oldSelectionStart, el.oldSelectionEnd);
            } else {
                el.value = "";
            }
        }
    );
}

/**
 * Initial run for all input elements lock attrs
 * @param {Boolean} isReady
 */
 function initAttrs(isReady = false) {
    if (isReady) {
        inputs = [];
        document.querySelectorAll("input, textarea").forEach((element) => {
            let existId = element.id != "";
            if (existId) {
                inputs.push({
                    id: element.id,
                    max: element.maxLength > 1 ? element.maxLength : 100,
                });
            }
        });
    }

    inputs.forEach((input) => {
        onEvent(["input", "keypress", "drop", "paste"], "#\\" + input.id, (el) => {
            el = el.target;
            if (el.type != "file") {
                el.value = el.value.replace(/(<([^>]+)>)/gi, "");
                if (el.value.length > input.max) {
                    el.value = el.value.slice(0, input.max);
                    return false;
                }
            }
        });
    });
}

function updateDirectly() {
    document.getElementById('update-book-id').addEventListener('keyup',function(){
        var link = document.getElementById('update-directly')
        var href = link.getAttribute('href')
    })
}

//Functions run on ready dom
ready(() => {
    onlyLetters();
    onlyNumbers();
    onlyEmail();
    onlyNoSpaces();
    onlyNoPaste();
    initAttrs(true);
});
