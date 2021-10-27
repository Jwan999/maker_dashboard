Nova.booting((Vue, router, store) => {
  Vue.component('index-product-view', require('./components/IndexField'))
  Vue.component('detail-product-view', require('./components/DetailField'))
  Vue.component('form-product-view', require('./components/FormField'))
})
