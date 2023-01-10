// import Vue from 'vue'
// import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'

// Vue.use(Vuetify)

// const opts = {}

// export default new Vuetify(opts)

import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/lib/styles/main.sass'
import { createVuetify } from 'vuetify'
import * as components from '/node_modules/vuetify/lib/components'
import * as directives from '/node_modules/vuetify/lib/directives'

export default createVuetify({
  components,
  directives,
})
