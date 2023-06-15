(function() {
  const el = wp.element.createElement;
  const { Fragment } = wp.element;
  const { InspectorControls, MediaUpload } = wp.blockEditor;
  const { createHigherOrderComponent } = wp.compose;
  const { addFilter } = wp.hooks;
  const { Button, PanelBody } = wp.components;

  addFilter('blocks.registerBlockType', 'extend-cover/attributes', addAttribute);
  addFilter('editor.BlockEdit', 'extend-cover/edit', createHigherOrderComponent(addControl));

  function addAttribute(settings, name) {
    // Abort if not Cover
    if (!['core/cover'].includes(name)) {
      return settings;
    }

    // add new attribute
    settings.attributes = Object.assign(settings.attributes, {
      mobileImageID: { type: 'number' },
      mobileImageURL: { type: 'string' },
    });

    return settings;
  }

  function addControl(BlockEdit) {
    return (props) => {
      if (!['core/cover'].includes(props.name)) {
        return el(BlockEdit, props);
      }

      const atts = props.attributes;

      return el(Fragment, {},
        el(BlockEdit, props),
        el(InspectorControls, {},
          el(PanelBody, {
            title: 'Mobile Cover',
            initialOpen: true,
          },
            el('div', {},
              ( atts.mobileImageURL &&
                el('img', {
                  src: atts.mobileImageURL
                })
              ),
              el(MediaUpload, {
                allowedTypes: 'image',
                value: atts.mobileImageID,
                onSelect: setMobileImage,
                render: renderMobileImage,
              })
            )
          )
        )
      );

      function setMobileImage(media) {
        props.setAttributes({
          mobileImageURL: media.url,
          mobileImageID: media.id,
        });
      }

      function renderMobileImage(obj) {
        const buttonLabel = atts.mobileImageID ? 'Change image' : 'Upload image';
  
        return el(Button, {
          className: 'button',
          onClick: obj.open,
        },
          buttonLabel
        );
      }
    }
  }

}());