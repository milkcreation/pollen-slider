'use strict'

import Glide from '@glidejs/glide'
import AbstractPlugin from '@pollen-solutions/support/resources/assets/src/js/abstract-plugin';
import MutationObserver from '@pollen-solutions/support/resources/assets/src/js/mutation-observer'

class Slider extends AbstractPlugin {
  constructor(el, options = {}) {
    super(el, options)

    this.verbose = false

    /**
     * @param {Glide}
     */
    this.glide = undefined

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

    this.glide.destroy()

    if (this.verbose) console.log('Slider destroyed')
  }

  // INITIALIZATIONS
  // -------------------------------------------------------------------------------------------------------------------
  // Controls initialization.
  _initControls() {
    const self = this

    this.glide = new Glide(this.el, this.options)

    this.glide.on(['mount.after', 'run'], () => {
      const currentPageNum = this.glide.index + 1,
          totalPage = this.glide._c.Sizes.length,
          $pageCurrents = self.el.querySelectorAll('.glide__page_current'),
          $pageTotals = self.el.querySelectorAll('.glide__page_total')

      if ($pageCurrents) {
        $pageCurrents.forEach($pageCurrent => {
          $pageCurrent.innerHTML = currentPageNum
        })
      }

      if ($pageTotals) {
        $pageTotals.forEach($pageTotal => {
          $pageTotal.innerHTML = totalPage
        })
      }
    })

    this.glide.mount()

    if (this.verbose) console.log('Slider controls initialized')
  }
}

window.addEventListener('load', e => {
  const $sliders = document.querySelectorAll('[data-observe="slider"]');

  $sliders.forEach($slider => {
    new Slider($slider)
  })

  MutationObserver('[data-observe="slider"]', function ($slider) {
    new Slider($slider)
  })
})

