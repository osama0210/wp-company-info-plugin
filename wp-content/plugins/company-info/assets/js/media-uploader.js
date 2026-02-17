jQuery(document).ready(function ($) {
    let frame

    $('#ci_media_button').on('click', function (e) {
        e.preventDefault();

        if (frame) {
            frame.open();
            return
        }

        frame = wp.media({
            title: 'Selecteer Afbeeldingen',
            multiple: true
        })

        frame.on('select', function () {
            let selection = frame.state().get('selection');
            const previewContainer = $('#ci-image-preview');
            let ids = [];

            previewContainer.empty();

            selection.map(function (attachment) {
                const imageData = attachment.toJSON();
                ids.push(imageData.id);

                previewContainer.append(`<img src="${imageData.sizes.thumbnail.url}">`);
            });
            $('#ci_gallery_ids').val(ids.join(','));
        })
        frame.open();
    })
})