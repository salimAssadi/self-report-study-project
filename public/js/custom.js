$(document).ready(function () {
    "use strict";
    select2();
    datatable();
    ckediter();
    setInterval(() => {
        feather.replace();
    }, 1000);
});

$(document).on("click", ".customModal", function () {
    "use strict";
    var modalTitle = $(this).data("title");
    var modalUrl = $(this).data("url");
    var modalSize = $(this).data("size") == "" ? "md" : $(this).data("size");
    $("#customModal .modal-title").html(modalTitle);
    $("#customModal .modal-dialog").addClass("modal-" + modalSize);
    $.ajax({
        url: modalUrl,
        success: function (result) {
            if (result.status == "error") {
                notifier.show(
                    "Error!",
                    result.messages,
                    "error",
                    errorImg,
                    4000
                );
            } else {
                $("#customModal .body").html(result);
                $("#customModal").modal("show");
                select2();
                ckediter();
            }
        },
        error: function (result) { },
    });
});

// basic message
$(document).on("click", ".confirm_dialog", function (e) {
    "use strict";
    var title = $(this).attr("data-dialog-title");
    if (title == undefined) {
        var title = "Are you sure you want to delete this record ?";
    }
    var text = $(this).attr("data-dialog-text");
    if (text == undefined) {
        var text = "This record can not be restore after delete. Do you want to confirm?";
    }
    var dialogForm = $(this).closest("form");
    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((data) => {
        if (data.isConfirmed) {
            dialogForm.submit();
        }
    });
});

// common
$(document).on("click", ".common_confirm_dialog", function (e) {
    "use strict";
    var dialogForm = $(this).closest("form");
    var actions = $(this).data("actions");
    Swal.fire({
        title: "Are you sure you want to delete " + actions + " ?",
        text:
            "This " +
            actions +
            " can not be restore after delete. Do you want to confirm?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((data) => {
        if (data.isConfirmed) {
            dialogForm.submit();
        }
    });
});

$(document).on("click", ".fc-day-grid-event", function (e) {
    "use strict";
    e.preventDefault();
    var event = $(this);
    var modalTitle = $(this).find(".fc-content .fc-title").html();
    var modalSize = "md";
    var modalUrl = $(this).attr("href");
    $("#customModal .modal-title").html(modalTitle);
    $("#customModal .modal-dialog").addClass("modal-" + modalSize);
    $.ajax({
        url: modalUrl,
        success: function (result) {
            $("#customModal .modal-body").html(result);
            $("#customModal").modal("show");
        },
        error: function (result) { },
    });
});

function toastrs(title, message, status) {
    "use strict";
    if (status == "success") {
        notifier.show("Success!", message, "success", successImg, 4000);
    } else {
        notifier.show("Success!", message, "success", errorImg, 4000);
    }
}

function convertArrayToJson(form) {
    "use strict";
    var data = $(form).serializeArray();
    var indexed_array = {};

    $.map(data, function (n, i) {
        indexed_array[n["name"]] = n["value"];
    });

    return indexed_array;
}

function select2() {
    "use strict";
    if ($(".basic-select").length > 0) {
        $(".basic-select").each(function () {
            var basic_select = new Choices(this, {
                searchEnabled: false,
                removeItemButton: false,
            });
        });
    }

    "use strict";
    if ($(".showsearch").length > 0) {
        $(".showsearch").each(function () {
            var basic_select = new Choices(this, {
                searchEnabled: true,
                removeItemButton: true,
            });
        });
    }

    if ($(".hidesearch").length > 0) {
        $(".hidesearch").each(function () {
            var basic_select = new Choices(this, {
                searchEnabled: false,
                removeItemButton: true,
            });
        });
    }

}

function ckediter(editer_id = "") {
    if (editer_id == "") {
        editer_id = "#classic-editor";
    }
    if ($(editer_id).length > 0) {
        ClassicEditor.create(document.querySelector(editer_id), {
            // Add configuration options here
            // height: '300px', // Example height, adjust as needed
        })
            .then((editor) => {
                // Set the minimum height directly // editor.ui.view.editable.element.style.minHeight = '300px';
            })
            .catch((error) => {
                console.error(error);
            });
    }
}
function datatable() {
    "use strict";

    $(".basic-datatable").DataTable({
        scrollX: true,
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "print"],
        columnDefs: [
            {
                targets: "_all", // Apply to all columns
                defaultContent: "-", // Fallback content
            },
        ],
        language: {
            emptyTable: `
                <div style="text-align: center; margin-top: 20px;">
                    <img src="/assets/images/notification/medium_priority-48" alt="No Data" style="width: 100px; height: auto;">
                    <p style="font-size: 16px; color: #888;">Sorry, no data available.</p>
                </div>
            `,
        },
    });

    if ($(".advance-datatable").length > 0) {
        $(".advance-datatable").DataTable({
            scrollX: true,
            stateSave: false,
            dom: "Bfrtip",
            buttons: [
                {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: ":visible",
                    },
                },
                {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: ":visible",
                    },
                },
                {
                    extend: "copyHtml5",
                    exportOptions: {
                        columns: ":visible",
                    },
                },

                "colvis",
            ],
            language: {
                emptyTable: `
                <div style="text-align: center; margin-top: 20px;">
                    <svg height="200px" width="200px" version="1.1" id="_x36_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path style="fill:#f0e138;" d="M431.942,88.352v291.165c0,2.162-0.289,4.184-0.794,6.202c-0.072,0-0.072,0.072-0.072,0.144 c-1.009,3.823-2.957,7.357-5.698,10.241c-4.255,4.833-10.458,8.007-17.382,8.223h-0.072c-0.289,0.072-0.577,0.072-0.866,0.072 H26.246c-3.967,0-7.645-0.938-10.963-2.597c-4.904-2.451-8.871-6.418-11.324-11.322c-1.154-2.308-1.947-4.833-2.308-7.501 c-0.216-1.155-0.288-2.309-0.288-3.462V88.352c0-13.703,11.251-24.955,24.883-24.955h380.814 C420.691,63.397,431.942,74.649,431.942,88.352z"></path> <path style="fill:#f0e138;" d="M431.942,88.352v291.165c0,2.162-0.289,4.184-0.794,6.202c-0.072,0-0.072,0.072-0.072,0.144 c-1.009,3.823-2.957,7.357-5.698,10.241c-4.255,4.833-10.458,8.007-17.382,8.223h-0.072c-0.289,0.072-0.577,0.072-0.866,0.072 H26.246c-3.967,0-7.645-0.938-10.963-2.597c-4.904-2.451-8.871-6.418-11.324-11.322c-1.154-2.308-1.947-4.833-2.308-7.501 c-0.216-1.155-0.288-2.309-0.288-3.462V88.352c0-13.703,11.251-24.955,24.883-24.955h380.814 C420.691,63.397,431.942,74.649,431.942,88.352z"></path> <path style="fill:#f0e138;" d="M216.508,141.796H33.458c-3.39,0-6.563-0.433-9.665-1.227c-12.91-3.101-22.43-12.549-22.43-23.657 V24.884C1.363,11.179,15.86,0,33.458,0h99.459l37.36,63.397l13.271,22.43l12.549,21.35L216.508,141.796z"></path> <path style="fill:#FFFFFF;" d="M26.266,381.982c-1.327,0-2.489-1.162-2.489-2.489V88.318c0-1.327,1.162-2.489,2.489-2.489h380.767 c1.327,0,2.489,1.162,2.489,2.489v291.175c0,1.327-1.162,2.489-2.489,2.489H26.266z"></path> <path style="fill:#f0e138;" d="M510.629,128.814c0.072,0.072,0,0.072,0,0.144l-2.02,6.635l-10.314,33.394l-11.035,35.701 l-10.314,33.32l-11.035,35.703l-10.241,33.392l-23.801,76.883c-0.217,0.578-0.505,1.153-0.722,1.731 c-0.072,0-0.072,0.072-0.072,0.144c-0.072,0.072-0.144,0.144-0.144,0.144c0,0.072-0.072,0.217-0.144,0.289 c-4.039,8.149-12.982,15.073-22.503,17.959c-0.144,0-0.216,0.072-0.288,0.072h-0.072c-3.174,0.937-6.275,1.442-9.376,1.442H17.807 c-12.549,0-19.834-8.221-17.309-18.751c0.144-1.011,0.505-2.02,0.865-3.03l0.288-1.009l22.142-71.62l52.362-169.561l3.967-12.838 c4.616-11.974,19.618-21.782,33.321-21.782h380.741C507.816,107.177,515.245,116.912,510.629,128.814z"></path> <polygon style="opacity:0.5;fill:#b1b0e8;" points="465.94,273.725 455.637,307.098 301.265,307.098 301.265,273.725 "></polygon> <polygon style="opacity:0.5;fill:#b1b0e8;" points="487.268,204.664 476.965,238.037 324.783,238.037 324.783,204.664 "></polygon> </g> <path style="opacity:0.06;fill:#040000;" d="M510.629,128.814c0.072,0.072,0,0.072,0,0.144l-2.02,6.635l-10.314,33.394 l-11.035,35.701l-10.314,33.32l-11.035,35.703l-10.241,33.392l-23.801,76.883c-0.217,0.578-0.505,1.153-0.722,1.731 c-0.072,0-0.072,0.072-0.072,0.144c-0.072,0.072-0.144,0.144-0.144,0.144c0,0.072-0.072,0.217-0.144,0.289 c-1.01,3.678-2.885,7.068-5.409,9.808c-4.255,4.761-10.314,7.79-17.093,8.151c-0.144,0-0.216,0.072-0.288,0.072h-0.072 c-3.174,0.937-6.275,1.442-9.376,1.442H53.076l1.37-1.37l22.43-22.431l274.792-274.791l21.348-21.35l22.431-22.43h11.612 c13.632,0,24.883,11.252,24.883,24.955v18.825h62.242C507.816,107.177,515.245,116.912,510.629,128.814z"></path> </g> </g></svg>
                    <p style="font-size: 16px; color: #888;">Sorry, no data available.</p>
                </div>
            `,
            },
        });
    }
}

if ($(".summernote").length) {
    "use strict";
    var lang = document.documentElement.lang;
    var directionality = (lang === 'ar') ? 'rtl' : 'ltr';
    var editor_config = {
        path_absolute: window.location.origin + "/",  // Use the current domain
        document_base_url: window.location.origin + "/",  // Use the current domain
        selector: "textarea.summernote",
        theme: 'silver', // Specify your custom theme name
        plugins: ' image  table   preview anchor    visualblocks visualchars code  tinymcespellchecker ',
        toolbar: ' undo redo  link |  emoticons styleselect  |fontfamily backcolor fontsize |alignleft aligncenter alignright alignjustify | preview language ',
        table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol link  ',
        content_langs: [
            { title: 'English ', code: 'en_US' },
            { title: 'Arabic', code: 'ar' }
        ],
        promotion: false,
        convert_urls: true,
        remove_script_host: false,
        relative_urls: false,
        directionality: directionality,
        file_picker_callback: function (callback, value, meta) {
            if (meta.filetype === 'image') {
                // Open the Alexusmai file manager
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: 'admin/file-manager', // Adjust this to your file manager route
                    title: 'File Manager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content); // Use the returned URL
                    }
                });
            }
        }

    };

    tinymce.init(editor_config);
}


