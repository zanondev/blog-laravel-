import './bootstrap';

$('.nav-menu-toggle').on('click', () => {
    $('header').toggleClass('menu-open')
})

$('.search-blog-form').submit(function (e) {
    e.preventDefault();
    let inputSearch = $(this).find("input[name='search-input']").val()
    if (inputSearch != "") {
        window.location.href = `${urlSearch}/${inputSearch}`;
    }
});

const paginateBlog = () => {
    let posts = document.getElementsByClassName('post-item')
    posts = Array.from(posts);

    if(posts.length > 3){
        $('#paginate-blog').pagination({
            dataSource: posts,
            pageSize: 3,
            showPrevious:true,
            showNext: true,
            showPageNumbers: true,
            // prevText: "<button class='swiper-button-prev><button>"
            // nextText: "<button class='swiper-button-prev><button>"
            callback: function (data, pagination){
                $(".geral-list").html(data);
            }

        })


    }
}

paginateBlog()