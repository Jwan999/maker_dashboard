Nova.booting((Vue, router, store) => {
  Vue.component('index-startup-view', require('./components/IndexField'))
  Vue.component('detail-startup-view', require('./components/DetailField'))
  Vue.component('form-startup-view', require('./components/FormField'))
})
