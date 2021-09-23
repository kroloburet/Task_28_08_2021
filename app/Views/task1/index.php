<p>Оберіть категорію зі списку ліворуч.</p>

<script>
    document.addEventListener(`DOMContentLoaded`, () => {
        /**
         * Ajax loading main section
         *
         * @type {jQuery|HTMLElement|*}
         */
        let links = $(`#aside_links a`),
            main_wrapper = $(`#main_wrapper`);
        links.each(function () {
            $(this).on(`click`, e => {
                let el = e.target;
                main_wrapper.load(`${el.href} #main`);
                e.preventDefault();
            })
        })
    })
</script>