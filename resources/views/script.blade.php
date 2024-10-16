<script>
    "use strict";
    document.addEventListener("DOMContentLoaded", function() {
        // Restore scroll position if it exists in localStorage
        const scrollPos = localStorage.getItem('navScrollPos');
        const sidebarNavArea = document.querySelector('.sidebar-nav-area');
        if (scrollPos) {
            sidebarNavArea.scrollTop = scrollPos;
        }

        // Ensure the active element is visible
        const activeElement = document.querySelector('.sidebar-nav-area .active');
        if (activeElement) {
            const activeElementTop = activeElement.getBoundingClientRect().top;
            const navAreaTop = sidebarNavArea.getBoundingClientRect().top;
            const navAreaBottom = navAreaTop + sidebarNavArea.clientHeight;

            if (activeElementTop < navAreaTop || activeElementTop > navAreaBottom) {
                sidebarNavArea.scrollTop = activeElement.offsetTop - sidebarNavArea.offsetTop;
            }
        }

        // Save scroll position before page unload
        window.addEventListener('beforeunload', function() {
            localStorage.setItem('navScrollPos', sidebarNavArea.scrollTop);
        });
    });

    $(document).ready(function() {
        $('.fc .fc-button').removeAttr('disabled');
    });
</script>

<script>
    "use strict";

    function showRightModal(url, header) {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#right-modal .offcanvas-body').html(
            '<div class="modal-spinner-border"><div class="spinner-border text-secondary" role="status"></div></div>'
        );
        jQuery('#right-modal .offcanvas-title').html("Loading...");
        // LOADING THE AJAX MODAL


        const bsOffcanvas = new bootstrap.Offcanvas('#right-modal');
        bsOffcanvas.show();

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response) {
                jQuery('#right-modal .offcanvas-title').html(header);
                jQuery('#right-modal .offcanvas-body').html(response);

            }
        });
    }
</script>

<script type="text/javascript">
    "use strict";

    function ajaxModal(url, title, modalClasses = 'modal-md', animation = 'fade') {
        $('#ajaxModal .modal-dialog').removeClass('modal-sm');
        $('#ajaxModal .modal-dialog').removeClass('modal-md');
        $('#ajaxModal .modal-dialog').removeClass('modal-lg');
        $('#ajaxModal .modal-dialog').removeClass('modal-xl');
        $('#ajaxModal .modal-dialog').removeClass('modal-xxl');
        $('#ajaxModal .modal-dialog').removeClass('modal-fullscreen');
        $('#ajaxModal .modal-dialog').addClass(modalClasses);

        $('#ajaxModal').removeClass('fade');
        $('#ajaxModal').addClass(animation);

        $('#ajaxModal .modal-title').html(title);
        $("#ajaxModal").modal('show');
        $.ajax({
            type: 'get',
            url: url,
            success: function(response) {
                $('#ajaxModal .modal-body').html(response);
            }
        });
    }

    const myModalEl = document.getElementById('ajaxModal')
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $('#ajaxModal .modal-body').html(
            '<div class="w-100 text-center py-5"><div class="spinner-border my-5" role="status"><span class="visually-hidden"></span></div></div>'
        );
    })



    // function confirmModal(url, elem = false, actionType = null, content = null) {
    //     $("#confirmModal").modal('show');

    //     if (elem != false) {
    //         $.ajax({
    //             url: url,
    //             success: function(response) {
    //                 response = JSON.parse(response);
    //                 //For redirect to another url
    //                 if (typeof response.success != "undefined") {
    //                     window.location.href = response.success;
    //                 }
    //                 distributeServerResponse(response);
    //             }
    //         });
    //     } else {
    //         $('#confirmModal .confirm-btn').attr('href', url);
    //         $('#confirmModal .confirm-btn').removeAttr('onclick');
    //     }
    // }
</script>

<script type="text/javascript">
    "use strict";

    $(function() {
        //The form of submission to RailTeam js is defined here.(Form class or ID)
        $('.aiAjaxFormSubmission').ajaxForm({
            beforeSend: function() {
                $('#aiSubmissionBtn').html("Generating");
                $('#aiSubmissionBtn').attr('disabled', true);
            },
            uploadProgress: function(event, position, total, percentComplete) {

            },
            complete: function(xhr) {
                var response = xhr.responseText;

                if (/^[\],:{}\s]*$/.test(response.replace(/\\["\\\/bfnrtu]/g, '@').replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
                        ']').replace(/(?:^|:|,)(?:\s*\[)+/g, '')) && $('#ai_service_selector')
                    .val() == 'Course thumbnail') {
                    var parsedJson = JSON.parse(response);
                    $('#aiGeneratedText').html('<div class="row"></div>');
                    console.log(parsedJson.length);
                    for (let i = 0; i < parsedJson.length; i++) {
                        var exi = i + 1;
                        var img =
                            '<div class="w-50 p-2 position-relative"><a class="position-absolute btn btn-success px-1 py-0 m-1" href="admin/ai_img_download?index=' +
                            exi +
                            '" target="_blank"><i class="fas fa-download"></i></a><img class="radius-5px" width="100%" src="' +
                            parsedJson[i].url +
                            '"></div>';
                        $('#aiGeneratedText .row').append(img);
                    }
                    $('#aiResultHeader').html('Your images:');
                    $('#aiGeneratedText').attr('contenteditable', 'false');
                } else {
                    $('#aiGeneratedText').html(response);
                    $('#aiGeneratedText').append('<input type="text" value="' + response +
                        '" id="generatedAiText" class="visibility-hidden">');
                    $('#aiResultHeader').html(
                        '<span class="text-14px">Generated text:</span> <a href="javascript:;" onclick="copy_text(this)" data-toggle="tooltip" data-placement="top" title="Copy" class="float-right btn p-0"><i class="far fa-copy"></i> Copy</a>'
                    );
                }


                $('#aiSubmissionBtn').html("Generate");
                $('#aiSubmissionBtn').attr('disabled', false);
            },
            error: function() {
                //You can write here your js error message
            }
        });
    });

    function copy_text(e) {
        // Get the text field
        var copyText = document.getElementById("generatedAiText");
        console.log(copyText);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        $(e).html('<i class="far fa-copy"></i> Copied!')
    }
</script>

<script>
    "use strict";

    function toaster_message(type, icon, header, message) {
        var toasterMessage = '<div class="toast ' + type +
            ' fade" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"> <i class="' +
            icon + ' me-2 mt-2px text-20px"></i> <strong class="me-auto"> ' + header +
            ' </strong><small>Just Now</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' +
            message + '</div></div>';
        $('.toast-container').prepend(toasterMessage);
        const toast = new bootstrap.Toast('.toast')
        toast.show()
    }

    function success(message) {
        toaster_message('success', 'fi-sr-badge-check', 'Success !', message);
    }

    function warning(message) {
        toaster_message('warning', 'fi-sr-exclamation', 'Attention !', message);
    }

    function error(message) {
        toaster_message('error', 'fi-sr-triangle-warning', 'An Error Occurred !', message);
    }
</script>

<script>
    "use strict";

    $(function() {
        $('a[href="#"]').on('click', function(event) {
            event.preventDefault();
        });
    });

    function redirectTo(url) {
        $(location).attr('href', url);
    }

    function actionTo(url, type = "get") {
        //Start prepare get url to post value
        var jsonFormate = '{}';
        if (type == 'post') {
            let pieces = url.split(/[\s?]+/);
            let lastString = pieces[pieces.length - 1];
            jsonFormate = '{"' + lastString.replace('=', '":"').replace("&", '","').replace("=", '":"').replace("&",
                '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=",
                '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&",
                '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=",
                '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&",
                '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","') + '"}';
        }
        jsonFormate = JSON.parse(jsonFormate);
        //End prepare get url to post value
        $.ajax({
            type: type,
            url: url,
            data: jsonFormate,
            headers: {
                'X-CSRF-TOKEN': 'UQzRLXQ0TGBRQpRQXL94kNkAK4juUyIyQ4hYVMsN'
            },
            success: function(response) {
                distributeServerResponse(response);
            }
        });
    }

    //Server response distribute
    function distributeServerResponse(response) {
        try {
            JSON.parse(response);
            var isValidJson = true;
        } catch (error) {
            var isValidJson = false;
        }
        if (isValidJson) {
            response = JSON.parse(response);
            //For reload after submission
            if (typeof response.reload != "undefined" && response.reload != 0) {
                location.reload();
            }

            //For redirect to another url
            if (typeof response.redirectTo != "undefined" && response.redirectTo != 0) {
                $(location).attr('href', response.redirectTo);
            }

            //for show a element
            if (typeof response.show != "undefined" && response.show != 0 && $(response.show).length) {
                $(response.show).css('display', 'inline-block');
            }
            //for hide a element
            if (typeof response.hide != "undefined" && response.hide != 0 && $(response.hide).length) {
                $(response.hide).hide();
            }
            //for fade in a element
            if (typeof response.fadeIn != "undefined" && response.fadeIn != 0 && $(response.fadeIn).length) {
                $(response.fadeIn).fadeIn();
            }
            //for fade out a element
            if (typeof response.fadeOut != "undefined" && response.fadeOut != 0 && $(response.fadeOut).length) {
                $(response.fadeOut).fadeOut();
            }

            //For adding a class
            if (typeof response.addClass != "undefined" && response.addClass != 0 && $(response.addClass.elem).length) {
                $(response.addClass.elem).addClass(response.addClass.content);
            }
            //For remove a class
            if (typeof response.removeClass != "undefined" && response.removeClass != 0 && $(response.removeClass.elem)
                .length) {
                $(response.removeClass.elem).removeClass(response.removeClass.content);
            }
            //For toggle a class
            if (typeof response.toggleClass != "undefined" && response.toggleClass != 0 && $(response.toggleClass.elem)
                .length) {
                $(response.toggleClass.elem).toggleClass(response.toggleClass.content);
            }

            //For showing error message
            if (typeof response.error != "undefined" && response.error != 0) {
                error(response.error);
            }
            //For showing warning message
            if (typeof response.warning != "undefined" && response.warning != 0) {
                warning(response.warning);
            }
            //For showing success message
            if (typeof response.success != "undefined" && response.success != 0) {
                success(response.success);
            }

            //For replace texts in a specific element
            if (typeof response.text != "undefined" && response.text != 0 && $(response.text.elem).length) {
                $(response.text.elem).text(response.text.content);
            }
            //For replace elements in a specific element
            if (typeof response.html != "undefined" && response.html != 0 && $(response.html.elem).length) {
                $(response.html.elem).html(response.html.content);
            }
            //For replace elements in a specific element
            if (typeof response.load != "undefined" && response.load != 0 && $(response.load.elem).length) {
                $(response.load.elem).html(response.load.content);
            }
            //For appending elements
            if (typeof response.append != "undefined" && response.append != 0 && $(response.append.elem).length) {
                $(response.append.elem).append(response.append.content);
            }
            //Fo prepending elements
            if (typeof response.prepend != "undefined" && response.prepend != 0 && $(response.prepend.elem).length) {
                $(response.prepend.elem).prepend(response.prepend.content);
            }
            //For appending elements after a element
            if (typeof response.after != "undefined" && response.after != 0 && $(response.after.elem).length) {
                $(response.after.elem).after(response.after.content);
            }

            // Update the browser URL and add a new entry to the history
            if (typeof response.pushState != "undefined" && response.pushState != 0) {
                history.pushState({}, response.pushState.title, response.pushState.url);
            }
            //For form validation Error
            if (typeof response.validationError != "undefined" && response.validationError != 0) {
                $('.form-validation-error-label').remove();
                let errorList = '<ul>';
                Object.keys(response.validationError).forEach(key => {
                    if ($("[name=" + key + "]").length > 0) {
                        $("[name=" + key + "]").after(
                            '<small class="text-danger text-12px form-validation-error-label">' + response
                            .validationError[key][0] + '</small>');
                    } else if ($("input[name='" + key + "[]']").length > 0) {
                        $("input[name='" + key + "[]']").after(
                            '<small class="text-danger text-12px form-validation-error-label">' +
                            response.validationError[key][0] + '</small>');
                    }

                    errorList = errorList + '<li>' + response.validationError[key][0] + '</li>';
                });
                errorList = errorList + '</ul>';

                error(errorList);
            }

            if (typeof response.script != "undefined" && response.script != 0) {
                response.script
            }
        }
    }

    function loadView(url, element, check_already_loaded) {
        if ($(element).text() == '' && check_already_loaded || !check_already_loaded) {
            $.ajax({
                url: url,
                success: function(response) {
                    $(element).html(response);
                }
            });
        }
    }

    function downloadPDF(elem = ".print-table", fileName = 'data') {
        $('.print-d-none:not(.row, .ol-header, .ol-card)').addClass('d-none');
        // Get the table element as HTML
        const table = document.querySelector(elem);

        // Options for html2pdf
        const options = {
            margin: 0.5,
            filename: fileName,
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        // Generate PDF from the table
        if (html2pdf().from(table).set(options).save()) {
            setInterval(() => {
                $('.print-d-none').removeClass('d-none');
            }, 2000);
        }

    }

    function downloadTableAsCSV(elem, filename = 'data.csv') {
        // Select the table element
        var table = document.querySelector(elem);

        // Initialize CSV string
        var csv = [];

        // Iterate over table rows
        var rows = table.rows;
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].cells;

            // Iterate over table cells
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }

            // Join the row elements with commas
            csv.push(row.join(','));
        }

        // Join the rows with newline character
        var csvData = csv.join('\n');

        // Create a Blob object containing the CSV data
        var blob = new Blob([csvData], {
            type: 'text/csv'
        });

        // Create a temporary link to trigger the download
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = filename + '.csv';
        document.body.appendChild(link);
        link.trigger('click');
        document.body.removeChild(link);
    }
</script>
<script type="text/javascript">
    "use strict";

    $(function() {
        // Datatable
        if ($('#datatable:not(.inited)').length) {
            $('#datatable:not(.inited)').DataTable();
            $('#datatable:not(.inited)').addClass('inited');

            $('#spinnner-before-table').addClass('d-none');
            $('.table-responsive').removeClass('d-none');
        }

        // Date range picker
        if ($('.daterangepicker:not(.inited)').length) {
            $('.daterangepicker:not(.inited)').daterangepicker();
            $('.daterangepicker:not(.inited)').addClass('inited');
        }

        // icon picker
        if ($('.icon-picker:not(.inited)').length) {
            $('.icon-picker:not(.inited)').iconpicker();
            $('.icon-picker:not(.inited)').addClass('inited');
        }

        //Select 2
        if ($('#ajaxModal select.ol-select2:not(.inited)').length) {
            $('#ajaxModal select.ol-select2:not(.inited)').select2({
                dropdownParent: $('#ajaxModal')
            });
            $('#ajaxModal select.ol-select2:not(.inited)').addClass('inited');
        }
        if ($('#right-modal select.ol-select2:not(.inited)').length) {
            $('#right-modal select.ol-select2:not(.inited)').select2({
                dropdownParent: $('#right-modal')
            });
            $('#right-modal select.ol-select2:not(.inited)').addClass('inited');
        }
        if ($('select.ol-select2:not(.inited)').length) {
            $('select.ol-select2:not(.inited)').select2();
            $('select.ol-select2:not(.inited)').addClass('inited');
        }

        if ($('#ajaxModal select.select2:not(.inited)').length) {
            $('#ajaxModal select.select2:not(.inited)').select2({
                dropdownParent: $('#ajaxModal')
            });
            $('#ajaxModal select.select2:not(.inited)').addClass('inited');
        }
        if ($('#right-modal select.select2:not(.inited)').length) {
            $('#right-modal select.select2:not(.inited)').select2({
                dropdownParent: $('#right-modal')
            });
            $('#right-modal select.select2:not(.inited)').addClass('inited');
        }
        if ($('select.select2:not(.inited)').length) {
            $('select.select2:not(.inited)').select2();
            $('select.select2:not(.inited)').addClass('inited');
        }

        //Text editor
        if ($('.text_editor:not(.inited)').length) {
            $('.text_editor:not(.inited)').summernote({
                height: 180, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true, // set focus to editable area after initializing summernote
                toolbar: [
                    ['color', ['color']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol']],
                    ['table', ['table']],
                    ['insert', ['link']]
                ]
            });
            $('.text_editor:not(.inited)').addClass('inited');
        }
        //summary, note_for_student, short_description, message, biography, type-msg, id="comment", summernote, address, website_description


        $('.tagify:not(.inited)').each(function(index, element) {
            var tagify = new Tagify(element, {
                placeholder: 'Enter your keywords'
            });
            $(element).addClass('inited');
        });

        var formElement;
        if ($('.ajaxForm:not(.initialized)').length > 0) {
            $('.ajaxForm:not(.initialized)').ajaxForm({
                beforeSend: function(data, form) {
                    var formElement = $(form);
                },
                uploadProgress: function(event, position, total, percentComplete) {},
                complete: function(xhr) {

                    setTimeout(function() {
                        distributeServerResponse(xhr.responseText);
                    }, 400);

                    if ($('.ajaxForm.resetable').length > 0) {
                        $('.ajaxForm.resetable')[0].reset();
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
            $('.ajaxForm:not(.initialized)').addClass('initialized');
        }
    });



    function printDiv(divId) {
        var printContents = document.getElementById(divId).outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>


<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendors/chart-js/chart.js"></script>



<script>
    "use strict";

    const xValues = [0, "January", "February", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"
    ];
    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                label: "Admin Revenue",
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: [0, 0, 0, 0, 0, 1302.912, 0, 0, 0, 0, 0, 0, 0]
            }]
        },
        options: {
            legend: {
                display: true
            },
        }
    });


    // Pie Chart 2
    const project_progress2 = document.getElementById('pie2');
    const progressData2 = {
        labels: ['Active', 'Upcoming', 'Pending', 'Private', 'Draft', 'Inactive'],
        data: [8, 1, 0, 0, 0, 0],
    };
    var barColors = [
        "#12c093",
        "#1b84ff",
        "#ff2583",
        "#000",
        "#878d97",
        "#dadada",
    ];
    new Chart(project_progress2, {
        type: 'doughnut',
        data: {
            labels: progressData2.labels,
            datasets: [{
                backgroundColor: barColors,
                label: ' Courses',
                data: progressData2.data,
            }, ],
        },
        options: {
            responsive: true,
            borderWidth: 5,
            hoverBorderColor: '#fff',
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    });
</script>

<script type="text/javascript">
    "use strict";

    let blank_faq = jQuery('#blank_faq_field').html();
    let blank_motivational_speech = jQuery('#blank_motivational_speech_field').html();
    $(document).ready(function() {

        jQuery('#blank_faq_field').hide();
        jQuery('#blank_motivational_speech_field').hide();

    });

    function appendFaq() {
        jQuery('#faq_area').append(blank_faq);
    }

    function removeFaq(faqElem) {
        jQuery(faqElem).parent().parent().remove();
    }

    function appendMotivational_speech() {
        jQuery('#motivational_speech_area').append(blank_motivational_speech);
    }

    function removeMotivational_speech(faqElem) {
        jQuery(faqElem).parent().parent().remove();
    }
</script>
