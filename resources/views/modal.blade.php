<!-- setup offcanvas -->
<div class="offcanvas global" data-bs-scroll="true" tabindex="-1" id="Id1" aria-labelledby="backdrop">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="backdrop"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body"></div>
</div>
<div class="placeholder-spinner d-none">
    <div class="d-flex justify-content-center align-items-center">
        <div class="spinner-border text-primary spinner-border-lg" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<script>
    function rightCanvas(url, title, position = '') {
        let spinner = $('.placeholder-spinner').html();
        let offcanvasBody = $('.global .offcanvas-body').empty().append(spinner);
        let canvasPosition = position == 'right' ? 'offcanvas-end' : 'offcanvas-start';

        $('.global .offcanvas-title').text(title);
        $('.global.offcanvas').addClass(position == '' ? 'offcanvas-end' : canvasPosition);
        $('.global.offcanvas').offcanvas('show');

        $.ajax({
            type: "get",
            url: url,
            success: function(response) {
                if (response) {
                    $('.global.offcanvas .offcanvas-body').empty().html(response);
                }
            }
        });
    }
</script>


<!-- confirm modal -->
<div class="modal fade" id="ajaxModal" aria-labelledby="ajaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-dark text-16px" id="ajaxModalLabel"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="w-100 text-center py-5">
                    <div class="spinner-border my-5" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn ol-btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" aria-labelledby="ajaxModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content pt-2">
            <div class="modal-body text-center">
                <div class="icon icon-confirm">
                    <i class="fi-rr-exclamation"></i>
                </div>
                <p class="title">Are you sure?</p>
                <p class="">You can&#039;t bring it back!</p>

            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn ol-btn-secondary fw-500" data-bs-dismiss="modal">Cancel</button>
                <a class="confirm-btn btn ol-btn-success fw-500">Confirm</a>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmModal(url, elem = false, actionType = null, content = null) {
        $("#confirmModal").modal('show');

        if (elem == false) {
            $('#confirmModal .confirm-btn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: url,
                    success: function(response) {
                        $("#confirmModal").modal('hide');
                        processServerResponse(response);
                    }
                });
            });
        } else {
            $('#confirmModal .confirm-btn').attr('href', url);
            $('#confirmModal .confirm-btn').removeAttr('onclick');
        }
    }
</script>


<div class="offcanvas offcanvas-end" tabindex="-1" id="right-modal" aria-labelledby="right-modalLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title title text-16px" id="right-modalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    </div>
</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">AI Assistant</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="aiAjaxFormSubmission" action="#open-ai/generate" method="post">
            <input type="hidden" name="_token" value="UQzRLXQ0TGBRQpRQXL94kNkAK4juUyIyQ4hYVMsN" autocomplete="off">
            <div class="mb-3">
                <label class="form-label ol-form-label" for="ai_service_selector">Select your service</label>
                <select class="ol-select2" id="ai_service_selector" name="service_type"
                    onchange="if(this.value == 'Course thumbnail'){$('#aiLanguageField').hide()}else{$('#aiLanguageField').show()}">
                    <option value="Course title" data-select2-id="2">Course title</option>
                    <option value="Course short description">Course short description</option>
                    <option value="Course short description">Course long description</option>
                    <option value="Course requirements">Course requirements</option>
                    <option value="Course outcomes">Course outcomes</option>
                    <option value="Course FAQ">Course faq</option>
                    <option value="Course SEO Tags">Course seo tags</option>
                    <option value="Course lesson text">Course lesson text</option>
                    <option value="Course certificate text">Course certificate text</option>
                    <option value="Course quiz text">Course quiz text</option>
                    <option value="Course blog title">Course blog title</option>
                    <option value="Course blog post">Course blog post</option>
                    <option value="Course thumbnail">Course thumbnail</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label ol-form-label" for="ai_keywords">Enter your keyword</label>
                <input type="text" class="form-control ol-form-control" id="ai_keywords" name="ai_keywords">
            </div>

            <div class="mb-3" id="aiLanguageField">
                <label class="form-label ol-form-label" for="language">Language</label>
                <select class="ol-select2" name="language">
                    <option value="english" class="text-capitalize">English</option>
                    <option value="hindi" class="text-capitalize">Hindi</option>
                    <option value="spanish" class="text-capitalize">Spanish</option>
                </select>
            </div>

            <button type="submit" id="aiSubmissionBtn" class="btn ol-btn-primary w-100">Generate</button>
        </form>

        <div class="row mt-3">
            <div class="col-md-12">
                <h5 id="aiResultHeader"></h5>
                <div id="aiGeneratedText" contenteditable="true"></div>
            </div>
        </div>
    </div>
</div>
