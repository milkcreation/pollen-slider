'use strict'

import Glide from '@glidejs/glide'
import AbstractPlugin from '@pollen-solutions/support/resources/assets/src/js/abstract-plugin';
import MutationObserver from '@pollen-solutions/support/resources/assets/src/js/mutation-observer'

class Slider extends AbstractPlugin {
  constructor(el, options = {}) {
    super(el, options)

    this.verbose = true

    /**
     * @param {Glide}
     */
    this.engine = undefined

    this._initOptions(options)
    this._initControls()
    this._init()
  }

  // Global initialization
  _init() {
    super._init();

    if (this.verbose) console.log('Slider fully initialized')
  }

  // Initialisation
  _destroy() {
    super._destroy();

    this.engine.destroy()

    if (this.verbose) console.log('Slider destroyed')
  }

  // INITIALIZATIONS
  // -------------------------------------------------------------------------------------------------------------------
  // Controls initialization.
  _initControls() {
    this.engine = new Glide(this.el, this.options).mount()

    if (this.verbose) console.log('Slider controls initialized')
  }
}

window.addEventListener('load', e => {
  const $sliders = document.querySelectorAll('[data-observe="slider"]');

  $sliders.forEach($slider => {
    new Slider($slider)
  })

  MutationObserver('[data-observe="slider"]', function ($slider)  {
    new Slider($slider)
  })
})

