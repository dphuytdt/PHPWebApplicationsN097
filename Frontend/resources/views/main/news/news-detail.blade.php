@extends('layouts.main') @section('content') @section('title', 'News')
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">News Detail</h3>
{{--                    {{ Breadcrumbs::render('newsDetail' , $news['id']) }}--}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog-single-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-3">
                <div class="siderbar-section">
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Search</h6>
                        <div class="sidebar-content">
                            <div class="search-bar">
                                <div class="default-search-style d-flex">
                                    <form action="{{route('news.search')}}" method="GET">
                                        <label>
                                            <input name="keyword" class="default-search-style-input-box border-around border-right-none" type="search" placeholder="{{__('messages.typeKeyWord')}}">
                                        </label>
                                        <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">{{__('messages.Recent Posts')}}</h6>
                        <div class="sidebar-content">
                            <div class="recent-post">
                                <ul>
                                    @foreach($recentNews as $recentNew)
                                        <li class="recent-post-list">
                                            <a href="{{route('newsDetail' , $recentNew['id'])}}" class="post-image">
                                                <img src="{{ $recentNew['image'] }}" alt="" />
                                            </a>
                                            <div class="post-content">
                                                <a class="post-link" href="">{{ $recentNew['title'] }}</a>
                                                @php
                                                    $date = date_create($recentNew['created_at']);
                                                    $date = date_format($date,"M d, Y");
                                                @endphp
                                                <span class="post-date">{{ $date }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Tag products</h6>
                        <div class="sidebar-content">
                            <div class="tag-link">
                                @foreach($tags as $tag)
                                    <a href="">{{ $tag['tag_name'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="blog-single-wrapper">
                    <div class="blog-single-img">
                        <img class="img-fluid" src="{{ $news['image'] }}" alt="" />
                    </div>
                    <div class="blog-feed-post-meta">
                        <span>{{__('messages.By:')}}</span>
                        <a href="{{route('newsDetail' , $news['id'])}}" class="blog-feed-post-meta-author">{{$news['creadted_by']}}</a> -
                        @php
                            $date = date_create($news['created_at']);
                            $date = date_format($date,"M d, Y");
                        @endphp
                        <a href="{{route('newsDetail' , $news['id'])}}" class="blog-feed-post-meta-date">{{ $date }}</a>
                    </div>
                    <h4 class="post-title">{{$news['title']}}</h4>
                    <div class="para-content">
                        @if($news['description'] != null)
                        <blockquote class="blockquote-content">
                            {{$news['description']}}
                        </blockquote>
                        @endif
                        <p>
                            {{$news['content']}}
                        </p>
                    </div>
                    <div class="para-tags">
                        <span>Tags: </span>
                        <ul>
                            @php
                                $tags = explode(',', $news['tags']);
                            @endphp
                            @foreach($tags as $tag)
                                <li><a href="">{{ $tag }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="comment-area">
                    <h4 class="mb-30" id="total-comment-news">{{$totalComment}} Comments</h4>
                    @if(session()->has('user'))
                        <div class="review-form">
                            <form action="#" onsubmit="onSubmitCommentNews(this); return false;">
                                @csrf
                                <input type="hidden" name="id" value="{{$news['id']}}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="default-form-box mb-20">
                                            <label for="comment-review-text">Your comment <span>*</span></label>
                                            <textarea name="comment" id="comment-review-text" placeholder="Write a comment" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="form-submit-btn" type="submit">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </br>
                        <ul class="comment">
                            @foreach($finalComment as $comment)
                                <li class="comment-list">
                                    <div class="comment-wrapper">
                                        <div class="comment-img">
                                            <img src="{{asset('assets/images/user/image-1.png')}}" alt="" />
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-content-top">
                                                <div class="comment-content-left">
                                                    <h6 class="comment-name">{{$comment[0]['comment_name']}}</h6>
                                                </div>
                                                <div class="comment-content-right">
                                                    <button>
                                                        <i class="fa fa-reply"
                                                           onclick="replyComment('{{$comment[0]['id']}}', '{{$news['id']}}', this, '{{$comment[0]['comment_name']}}', '{{$comment[0]['id']}}');"
                                                        >  {{__('messages.Reply')}}</i>
                                                    </button>
                                                    @if(session()->get('user')['id'] == $comment[0]['user_id'])
                                                        <span style="margin-left: 10px;">
                                                        <button>
                                                            <i class="fa fa-trash"
                                                               onclick="deleteComment('{{$comment[0]['id']}}', '{{$news['id']}}', this, '{{$comment[0]['comment_parent_id']}}');"
                                                            >  Delete</i>
                                                        </button>
                                                        <span style="margin-left: 10px;">
                                                        <button>
                                                            <i class="fa fa-pencil"
                                                               onclick="editComment('{{$comment[0]['id']}}', '{{$news['id']}}', this, '{{$comment[0]['content']}}');"
                                                            >  Edit</i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="para-content">
                                                <p>
                                                    {{$comment[0]['content']}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @for($i = 1; $i < count($comment); $i++)
                                        <ul class="comment-reply">
                                            <li class="comment-reply-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="{{asset('assets/images/user/image-1.png')}}" alt="" />
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">{{$comment[$i]['comment_name']}}</h6>
                                                            </div>
                                                            <div class="comment-content-right">
                                                                <button>
                                                                    <i class="fa fa-reply"
                                                                       onclick="replyComment('{{$comment[$i]['comment_parent_id']}}', '{{$news['id']}}', this, '{{$comment[$i]['comment_name']}}', '{{$comment[$i]['id']}}');"
                                                                    >  {{__('messages.Reply')}}</i>
                                                                </button>
                                                                @if(session()->get('user')['id'] == $comment[$i]['user_id'])
                                                                    <span style="margin-left: 10px;">
                                                                    <button>
                                                                        <i class="fa fa-trash"
                                                                           onclick="deleteComment('{{$comment[$i]['id']}}', '{{$news['id']}}', this, '{{$comment[$i]['comment_parent_id']}}');"
                                                                        >  Delete</i>
                                                                    </button>
                                                                    <span style="margin-left: 10px;">
                                                                    <button>
                                                                        <i class="fa fa-pencil"
                                                                           onclick="editComment('{{$comment[$i]['id']}}', '{{$news['id']}}', this, '{{$comment[$i]['content']}}');"
                                                                        >  Edit</i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>
                                                                {{$comment[$i]['content']}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    @endfor
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="product-add-to-cart-btn">
                            <a href="{{route('login')}}">{{__('messages.plsLogin')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(session()->has('user'))
    <script type="text/javascript">
        function replyComment(id, newsId, element, commentName, replyParentComment) {
            const formsWithHiddenInputs = document.querySelectorAll('form[action="#"]');
            const filteredForms = Array.from(formsWithHiddenInputs).filter(form => {
                const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
                const aInput = Array.from(hiddenInputs).find(input => input.name === 'parent_id');
                const bInput = Array.from(hiddenInputs).find(input => input.name === 'news_id');
                const cInput = Array.from(hiddenInputs).find(input => input.name === 'flag');

                return aInput !== undefined
                    && bInput !== undefined
                    && cInput !== undefined
                    && aInput.value == id
                    && bInput.value == newsId
                    && cInput.value == replyParentComment;
            });

            if (filteredForms.length > 0) {
                return;
            }

            var parent = element.closest(".comment-wrapper");

            // Create the new reply container
            var replyContainer = document.createElement("ul");
            replyContainer.className = "comment-reply";

            var replyListItem = document.createElement("li");
            replyListItem.className = "comment-reply-list";

            var newCommentWrapper = document.createElement("div");
            newCommentWrapper.className = "comment-wrapper";

            var commentContentDiv = document.createElement("div");
            commentContentDiv.className = "comment-content";

            var paraContentDiv = document.createElement("div");
            paraContentDiv.className = "para-content";

            var form = document.createElement("form");
            form.action = "#";
            form.onsubmit = function() {
                onSubmitReplyReview(this);
                return false;
            };

            var hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "parent_id";
            hiddenInput.value = id; // Use the parent comment's ID

            var hiddenInputBookId = document.createElement("input");
            hiddenInputBookId.type = "hidden";
            hiddenInputBookId.name = "id";
            hiddenInputBookId.value = newsId; // Use the parent comment's ID

            var hiddenCsrfToken = document.createElement("input");
            hiddenCsrfToken.type = "hidden";
            hiddenCsrfToken.name = "_token";
            hiddenCsrfToken.value = "{{csrf_token()}}";

            var hiddenReplyParentComment = document.createElement("input");
            hiddenReplyParentComment.type = "hidden";
            hiddenReplyParentComment.name = "flag";
            hiddenReplyParentComment.value = replyParentComment;

            var col12Div = document.createElement("div");
            col12Div.className = "col-12";

            var defaultFormBoxDiv = document.createElement("div");
            defaultFormBoxDiv.className = "default-form-box mb-20";

            var label = document.createElement("label");
            label.setAttribute("for", "comment-review-text");
            label.innerHTML = "Your review <span>*</span>";

            var textarea = document.createElement("textarea");
            textarea.id = "comment-review-text";
            textarea.placeholder = "Write a review";
            textarea.name = "comment";
            textarea.required = true;
            textarea.value = "@" + commentName + " ";

            var submitButton = document.createElement("button");
            submitButton.className = "form-submit-btn";
            submitButton.type = "submit";
            submitButton.innerHTML = "Submit";

            defaultFormBoxDiv.appendChild(label);
            defaultFormBoxDiv.appendChild(textarea);
            col12Div.appendChild(defaultFormBoxDiv);
            col12Div.appendChild(submitButton);
            form.appendChild(hiddenInput);
            form.appendChild(hiddenInputBookId);
            form.appendChild(hiddenCsrfToken);
            form.appendChild(hiddenReplyParentComment);
            form.appendChild(col12Div);
            paraContentDiv.appendChild(form);
            commentContentDiv.appendChild(paraContentDiv);
            newCommentWrapper.appendChild(commentContentDiv);
            replyListItem.appendChild(newCommentWrapper);
            replyContainer.appendChild(replyListItem);

            parent.parentNode.insertBefore(replyContainer, parent.nextSibling);
        }

        function onSubmitReplyReview(form) {
            const formData = new FormData(form);
            formData.append("type", 2);
            $.ajax({
                url: "{{route('replyReview')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(response){
                    if(response){
                        var generatedReply = generateNewReply(response);
                        var newReplyPosition = form.closest(".comment-reply");
                        var replyPosition =
                            form.closest(".comment-reply").previousElementSibling.querySelector(".comment-content-right");
                        newReplyPosition.replaceWith(generatedReply);
                        var totalComment = document.getElementById("total-comment-news");
                        var totalCommentNumber = totalComment.textContent.split(" ")[0];
                        totalCommentNumber = parseInt(totalCommentNumber) + 1;
                        totalComment.textContent = totalCommentNumber + " Comments";
                    } else {
                        swal({
                            title: "Error!",
                            text: "Reply review failed!",
                            icon: "error",
                            button: "OK",
                        });
                    }
                }
            });
        }

        function generateNewReply(response) {
            var ulElement = document.createElement('ul');
            ulElement.className = 'comment-reply';

            var liElement = document.createElement('li');
            liElement.className = 'comment-reply-list';

            const commentWrapper = document.createElement("div");
            commentWrapper.classList.add("comment-wrapper");

            const commentImgDiv = document.createElement("div");
            commentImgDiv.classList.add("comment-img");
            const commentImg = document.createElement("img");
            commentImg.src = "{{asset('assets/images/user/image-2.png')}}";
            commentImg.alt = "";
            commentImgDiv.appendChild(commentImg);

            const commentContentDiv = document.createElement("div");
            commentContentDiv.classList.add("comment-content");

            const commentContentTopDiv = document.createElement("div");
            commentContentTopDiv.classList.add("comment-content-top");

            const commentContentLeftDiv = document.createElement("div");
            commentContentLeftDiv.classList.add("comment-content-left");
            const commentName = document.createElement("h6");
            commentName.classList.add("comment-name");
            commentName.textContent = response['comment_name'];
            commentContentLeftDiv.appendChild(commentName);

            var commentContentRightDiv = document.createElement("div");
            commentContentRightDiv.className = "comment-content-right";
            commentContentRightDiv.id = "reply-parent-comment";

            var commentContentRightButton = document.createElement("button");
            var commentContentRightI = document.createElement("i");
            commentContentRightI.className = "fa fa-reply";
            commentContentRightI.textContent = "  {{__('messages.Reply')}}";
            commentContentRightI.onclick = function() {
                replyComment(response['comment_parent_id'], '{{$news['id']}}', this, response['comment_name'], response['id']);
            };

            var commentContentRightDeleteButton = document.createElement("button");
            var commentContentRightDeleteI = document.createElement("i");
            commentContentRightDeleteI.className = "fa fa-trash";
            commentContentRightDeleteI.textContent = "  Delete";
            commentContentRightDeleteI.onclick = function() {
                deleteComment(response['id'], {{$news['id']}}, this, response['comment_parent_id']);
            };

            var commentContentRightEditButton = document.createElement("button");
            var commentContentRightEditI = document.createElement("i");
            commentContentRightEditI.className = "fa fa-pencil";
            commentContentRightEditI.textContent = "  Edit";
            commentContentRightEditI.onclick = function() {
                editComment(response['id'], {{$news['id']}}, this, response['content']);
            };

            var commentContentLeftSpan1 = document.createElement("span");
            commentContentLeftSpan1.style.marginRight = "10px";

            var commentContentLeftSpan2 = document.createElement("span");
            commentContentLeftSpan2.style.marginRight = "10px";


            commentContentRightButton.appendChild(commentContentRightI);
            commentContentRightDiv.appendChild(commentContentRightButton);

            commentContentRightDiv.appendChild(commentContentLeftSpan1);

            commentContentRightDeleteButton.appendChild(commentContentRightDeleteI);
            commentContentRightDiv.appendChild(commentContentRightDeleteButton);

            commentContentRightDiv.appendChild(commentContentLeftSpan2);

            commentContentRightEditButton.appendChild(commentContentRightEditI);
            commentContentRightDiv.appendChild(commentContentRightEditButton);

            commentContentTopDiv.appendChild(commentContentLeftDiv);
            commentContentTopDiv.appendChild(commentContentRightDiv);

            const paraContentDiv = document.createElement("div");
            paraContentDiv.classList.add("para-content");
            const para = document.createElement("p");
            para.textContent = response['content'];
            paraContentDiv.appendChild(para);

            commentContentDiv.appendChild(commentContentTopDiv);
            commentContentDiv.appendChild(paraContentDiv);

            commentWrapper.appendChild(commentImgDiv);
            commentWrapper.appendChild(commentContentDiv);
            liElement.appendChild(commentWrapper);
            ulElement.appendChild(liElement);

            return ulElement;
        }

        function onSubmitCommentNews(form) {
            const formData = new FormData(form);
            formData.append("type", 2);
            var formPosition = form.closest(".review-form");
            var newReviewPosition = formPosition.nextElementSibling.nextElementSibling;
            var submitBtn = form.querySelector(".form-submit-btn");
            submitBtn.disabled = true;
            $.ajax({
                url: "{{route('review')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(response){
                    console.log(response);
                    if(response){
                        var generatedReview = generateNewReview(response);
                        newReviewPosition.insertBefore(generatedReview, newReviewPosition.firstChild);
                        var totalComment = document.getElementById("total-comment-news");
                        var totalCommentNumber = totalComment.textContent.split(" ")[0];
                        totalCommentNumber = parseInt(totalCommentNumber) + 1;
                        totalComment.textContent = totalCommentNumber + " Comments";
                        submitBtn.disabled = false;
                        form.reset();
                    }
                }
            });
        }

        function generateNewReview(response) {
            var liElement = document.createElement('li');
            liElement.className = 'comment-list';

            var commentWrapperDiv = document.createElement('div');
            commentWrapperDiv.className = 'comment-wrapper';

            var commentImgDiv = document.createElement('div');
            commentImgDiv.className = 'comment-img';

            var imgElement = document.createElement('img');
            imgElement.src = '{{asset("assets/images/user/image-1.png")}}';
            imgElement.alt = '';

            commentImgDiv.appendChild(imgElement);

            var commentContentDiv = document.createElement('div');
            commentContentDiv.className = 'comment-content';

            var commentContentTopDiv = document.createElement('div');
            commentContentTopDiv.className = 'comment-content-top';

            var commentContentLeftDiv = document.createElement('div');
            commentContentLeftDiv.className = 'comment-content-left';

            var commentContentRightDiv = document.createElement("div");
            commentContentRightDiv.className = "comment-content-right";
            commentContentRightDiv.id = "reply-parent-comment";

            var commentContentRightButton = document.createElement("button");
            var commentContentRightI = document.createElement("i");
            commentContentRightI.className = "fa fa-reply";
            commentContentRightI.textContent = "  {{__('messages.Reply')}}";
            commentContentRightI.onclick = function() {
                replyComment(response['id'], {{$news['id']}}, this, response['comment_name'], response['id']);
            };

            var commentContentRightDeleteButton = document.createElement("button");
            var commentContentRightDeleteI = document.createElement("i");
            commentContentRightDeleteI.className = "fa fa-trash";
            commentContentRightDeleteI.textContent = "  Delete";
            commentContentRightDeleteI.onclick = function() {
                deleteComment(response['id'], {{$news['id']}}, this, response['comment_parent_id']);
            };

            var commentContentRightEditButton = document.createElement("button");
            var commentContentRightEditI = document.createElement("i");
            commentContentRightEditI.className = "fa fa-pencil";
            commentContentRightEditI.textContent = "  Edit";
            commentContentRightEditI.onclick = function() {
                editComment(response['id'], {{$news['id']}}, this, response['content']);
            };

            var commentContentLeftSpan1 = document.createElement("span");
            commentContentLeftSpan1.style.marginRight = "10px";

            var commentContentLeftSpan2 = document.createElement("span");
            commentContentLeftSpan2.style.marginRight = "10px";


            commentContentRightButton.appendChild(commentContentRightI);
            commentContentRightDiv.appendChild(commentContentRightButton);
            commentContentRightDiv.appendChild(commentContentLeftSpan1);

            commentContentRightDeleteButton.appendChild(commentContentRightDeleteI);
            commentContentRightDiv.appendChild(commentContentRightDeleteButton);
            commentContentRightDiv.appendChild(commentContentLeftSpan2);

            commentContentRightEditButton.appendChild(commentContentRightEditI);
            commentContentRightDiv.appendChild(commentContentRightEditButton);

            var h6Element = document.createElement('h6');
            h6Element.className = 'comment-name';
            h6Element.textContent = response['comment_name'];

            commentContentLeftDiv.appendChild(h6Element);
            commentContentTopDiv.appendChild(commentContentLeftDiv);
            commentContentTopDiv.appendChild(commentContentRightDiv);

            var paraContentDiv = document.createElement('div');
            paraContentDiv.className = 'para-content';

            var pElement = document.createElement('p');
            pElement.textContent = response['content'];

            paraContentDiv.appendChild(pElement);

            commentContentDiv.appendChild(commentContentTopDiv);
            commentContentDiv.appendChild(paraContentDiv);

            commentWrapperDiv.appendChild(commentImgDiv);
            commentWrapperDiv.appendChild(commentContentDiv);

            liElement.appendChild(commentWrapperDiv);
            return liElement;
        }

        function deleteComment(commentId, newsId, element, isReply) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this comment!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                const formData = new FormData();
                formData.append('comment_id', commentId);
                formData.append('id', newsId);
                formData.append('type', 2);
                formData.append('_token', "{{csrf_token()}}");
                if (willDelete) {
                    $.ajax({
                        url: "{{route('deleteReview')}}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(response){
                            if(response){
                                var commentPosition = element.closest((isReply) ? ".comment-reply" : ".comment-list");
                                commentPosition.remove();
                                var totalComment = document.getElementById("total-comment-news");
                                var totalCommentNumber = totalComment.textContent.split(" ")[0];
                                totalCommentNumber = parseInt(totalCommentNumber) - response;
                                totalComment.textContent = totalCommentNumber + " Comments";
                            }
                        }
                    });
                }
            });
        }

        function editComment(commentId, newsId, element, text) {
            var commentPosition = element.closest(".comment-wrapper");
            var form = generateEditForm(text, newsId, commentId);
            commentPosition.parentNode.insertBefore(form, commentPosition.nextSibling);
            commentPosition.style.display = "none";
        }

        function generateEditForm(text, newsId, commentId) {
            var form = document.createElement("form");
            form.action = "#";
            form.id = "edit-comment-form";
            form.onsubmit = function() {
                onSubmitEditComment(this);
                return false;
            };

            var hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "comment_id";
            hiddenInput.value = commentId; // Use the parent comment's ID

            var hiddenInputNewsId = document.createElement("input");
            hiddenInputNewsId.type = "hidden";
            hiddenInputNewsId.name = "id";
            hiddenInputNewsId.value = newsId; // Use the parent comment's ID

            var hiddenCsrfToken = document.createElement("input");
            hiddenCsrfToken.type = "hidden";
            hiddenCsrfToken.name = "_token";
            hiddenCsrfToken.value = "{{csrf_token()}}";

            var col12Div = document.createElement("div");
            col12Div.className = "col-12";

            var defaultFormBoxDiv = document.createElement("div");
            defaultFormBoxDiv.className = "default-form-box mb-20";

            var label = document.createElement("label");
            label.setAttribute("for", "comment-review-text");
            label.innerHTML = "Your review <span>*</span>";

            var textarea = document.createElement("textarea");
            textarea.id = "comment-review-text";
            textarea.placeholder = "Write a review";
            textarea.name = "comment";
            textarea.required = true;
            textarea.value = text;

            var formButtonDiv = document.createElement("div");

            var submitButton = document.createElement("button");
            submitButton.className = "form-submit-btn";
            submitButton.type = "submit";
            submitButton.innerHTML = "Submit";
            submitButton.onclick = function() {
                onSubmitEditComment(this.closest("#edit-comment-form"));
                return false;
            };

            var formButtonSpan = document.createElement("span");
            formButtonSpan.innerHTML = "&nbsp;&nbsp;&nbsp;";

            var cancelButton = document.createElement("button");
            cancelButton.className = "form-submit-btn";
            cancelButton.type = "button";
            cancelButton.innerHTML = "Cancel";
            cancelButton.onclick = function() {
                var formPosition = this.closest("#edit-comment-form");
                var commentPosition = formPosition.previousElementSibling;
                commentPosition.style.display = "flex";
                formPosition.remove();
            };

            formButtonDiv.className = "d-flex";

            defaultFormBoxDiv.appendChild(label);
            defaultFormBoxDiv.appendChild(textarea);
            col12Div.appendChild(defaultFormBoxDiv);
            formButtonDiv.appendChild(submitButton);
            formButtonDiv.appendChild(formButtonSpan);
            formButtonDiv.appendChild(cancelButton);
            col12Div.appendChild(formButtonDiv);
            form.appendChild(hiddenInput);
            form.appendChild(hiddenInputNewsId);
            form.appendChild(hiddenCsrfToken);
            form.appendChild(col12Div);

            return form;
        }

        function onSubmitEditComment(form) {
            const formData = new FormData(form);
            formData.append("type", 2);
            $.ajax({
                url: "{{route('updateReview')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(response){
                    console.log(response)
                    if(response){
                        var commentPosition = form.previousElementSibling;
                        commentPosition.style.display = "flex";
                        commentPosition.querySelector(".para-content p").textContent = formData.get('comment');
                        form.remove();
                    }
                }
            });
        }
    </script>
@endif
@endsection
