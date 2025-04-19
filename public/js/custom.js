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
        // dom: "Bfrtip",
        // buttons: ["copy", "csv", "excel", "print"],
        columnDefs: [
            {
                targets: "_all", // Apply to all columns
                defaultContent: "-", // Fallback content
            },
        ],
        language: {
            emptyTable: `
                <div style="text-align: center; margin-top: 20px;">
                    <img src="/assets/images/empty.svg" alt="No Data" style="width: 100px; height: auto;">
                    <p style="font-size: 16px; color: #888;">Sorry, no data available.</p>
                </div>
            `,
        },
    });

    if ($(".advance-datatable").length > 0) {
        $(".advance-datatable").DataTable({
            scrollX: true,
            stateSave: false,
            // dom: "Bfrtip",
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
                    <img src="/assets/images/empty.svg" alt="No Data" style="width: 100px; height: auto;">
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
        font_formats:
        "Cairo=cairo,sans-serif; Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",        theme: 'silver', // Specify your custom theme name
        plugins: ' image  table   preview anchor    visualblocks visualchars code  tinymcespellchecker link ',
        toolbar: ' undo redo  link |  emoticons styleselect  |fontfamily backcolor fontsize |alignleft aligncenter alignright alignjustify | preview  ',
        table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol link  ',
        link_default_target: '_blank', 
        content_langs: [
            { title: 'English ', code: 'en_US' },
            { title: 'Arabic', code: 'ar' }
        ],
        setup: function (editor) {
            editor.on('init', function () {
                editor.getDoc().body.style.fontFamily = 'Cairo, sans-serif';
            });
        },
       
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


