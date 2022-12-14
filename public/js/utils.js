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
 * format mask
 * @param  x
 * @param  pattern
 * @param  mask
 * @return string
 */
function doFormat(x, pattern, mask) {
    var strippedValue = x.replace(/[^0-9]/g, "");
    var chars = strippedValue.split("");
    var count = 0;

    var formatted = "";
    for (var i = 0; i < pattern.length; i++) {
        const c = pattern[i];
        if (chars[count]) {
            if (/\*/.test(c)) {
                formatted += chars[count];
                count++;
            } else {
                formatted += c;
            }
        } else if (mask) {
            if (mask.split("")[i]) formatted += mask.split("")[i];
        }
    }
    return formatted;
}

/**
 * Init the mask on all inputs with data-mask
 */
function initMask() {
    document.querySelectorAll("[data-mask]").forEach(function (e) {
        function format(elem) {
            const val = doFormat(elem.value, elem.getAttribute("data-format"));
            elem.value = doFormat(
                elem.value,
                elem.getAttribute("data-format"),
                elem.getAttribute("data-mask")
            );

            if (elem.createTextRange) {
                var range = elem.createTextRange();
                range.move("character", val.length);
                range.select();
            } else if (elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(val.length, val.length);
            }
        }
        e.addEventListener("keyup", function () {
            format(e);
        });
        e.addEventListener("keydown", function () {
            format(e);
        });
        format(e);
    });
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
        onEvent(
            ["input", "keypress", "drop", "paste"],
            "#\\" + input.id,
            (el) => {
                el = el.target;
                if (el.type != "file") {
                    el.value = el.value.replace(/(<([^>]+)>)/gi, "");
                    if (el.value.length > input.max) {
                        el.value = el.value.slice(0, input.max);
                        return false;
                    }
                }
            }
        );
    });
}

/**
 * Debounce function
 * @param {Function} func
 * @param {Number} timeout
 * @returns
 */
const debounce = (func, timeout = 500) => {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, timeout);
    };
};

/**
 * init filters table listeners
 */
function initFilterTable() {
    var userFilter = document.querySelector("[name='user']");
    var serchFilter = document.getElementById("search");
    if (userFilter && serchFilter) {
        userFilter.addEventListener(
            "change",
            debounce((event) => {
                if (event.target.value) {
                    event.target.closest("form").submit();
                }
            }, 300)
        );

        serchFilter.addEventListener(
            "input",
            debounce((event) => {
                if (event.target.value) {
                    event.target.closest("form").submit();
                }
            }, 1000)
        );
    }
}
/**
 * Update directly by id
 */
function updateDirectly() {
    var updateTrigger = document.getElementById("update-book-id");
    if (updateTrigger) {
        updateTrigger.addEventListener(
            "keyup",
            debounce((event) => {
                if (event.target.value) {
                    var link = document.getElementById("update-directly");
                    var href = link.getAttribute("href");
                    href = href
                        .replace("{book}", event.target.value)
                        .replace(/^\d*$/, event.target.value);

                    document.location.href = href;
                }
            }, 700)
        );
    }
}

/**
 * Init slim select if is-select class in select
 */
function initSlimSelect() {
    document.querySelectorAll(".is-select").forEach((element) => {
        new SlimSelect({
            select: element,
            settings: {
                placeholderText:
                    element.getAttribute("placeholder") ?? "Select an option",
            },
        });
    });
}

/**
 * Init bootstrap delete confirmation modal
 */
function initDeleteBook() {
    const deleteBook = document.getElementById("deleteBook");
    if (deleteBook) {
        deleteBook.addEventListener("show.bs.modal", (event) => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute("data-bs-whatever");

            const modalBodyInput = deleteBook.querySelector("#deleteId");
            modalBodyInput.value = recipient;
        });
    }
}

//Functions run on ready dom
ready(() => {
    initMask();
    onlyEmail();
    onlyNoPaste();
    onlyLetters();
    onlyNumbers();
    onlyNoSpaces();
    initAttrs(true);
    initDeleteBook();
    initSlimSelect();
    updateDirectly();
    initFilterTable();
});
