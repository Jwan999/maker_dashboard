Nova.booting((Vue, router, store) => {
  Vue.component('index-trainer-view', require('./components/IndexField'))
  Vue.component('detail-trainer-view', require('./components/DetailField'))
  Vue.component('form-trainer-view', require('./components/FormField'))
})
