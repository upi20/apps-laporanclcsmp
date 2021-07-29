$(document).ready(function () {
    $(".text-ringgit").each(function (el) {
        const text = $(this);
        text.text("RM " + format_ringgit(text.text()));
    })
    $(".text-rupiah").each(function (el) {
        const text = $(this);
        text.text("Rp " + format_rupiah(text.text()));
    })
})