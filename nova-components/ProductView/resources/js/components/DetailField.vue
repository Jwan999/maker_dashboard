<template>
  <field>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <div>
      <div class="flex justify-end space-x-4">
        <button @click="paginate('previous')"
                :class="productIndex >= 1 ? 'bg-primary text-white': 'bg-gray-300 text-gray-600'"
                class="text-sm text-white px-5 py-2 rounded-lg font-bold">
          <svg class="w-4 h-4" viewBox="0 0 314 632" version="1.1"
               xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="arrow-left-2" fill="white" fill-rule="nonzero">
                <path
                    d="M286.530044,631.973333 C279.6056,631.973333 272.681156,629.422222 267.214489,623.955556 L29.5967111,386.337778 C-9.0344,347.706667 -9.0344,284.293333 29.5967111,245.662222 L267.214489,8.04517333 C277.783378,-2.52371556 295.276711,-2.52371556 305.8456,8.04517333 C316.414489,18.6140622 316.414489,36.1073956 305.8456,46.6762844 L68.2278222,284.293333 C50.7344889,301.786667 50.7344889,330.213333 68.2278222,347.706667 L305.8456,585.324444 C316.414489,595.893333 316.414489,613.386667 305.8456,623.955556 C300.378933,629.057778 293.454489,631.973333 286.530044,631.973333 Z"
                    id="Path"></path>
              </g>
            </g>
          </svg>
        </button>
        <button :class="productIndex < lastIndex ? 'bg-primary text-white': 'bg-gray-300 text-gray-600'"
                @click="paginate('next')" class="bg-primary text-sm text-white px-5 py-2 rounded-lg font-bold">
          <svg class="w-4 h-4" viewBox="0 0 137 275" version="1.1" xmlns="http://www.w3.org/2000/svg"
               xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="arrow-right-3" fill="white" fill-rule="nonzero">
                <path
                    d="M12.4021583,274.775 C9.393825,274.775 6.38549167,273.666667 4.01049167,271.291667 C-0.581175,266.7 -0.581175,259.1 4.01049167,254.508333 L107.243667,151.275 C114.843667,143.675 114.843667,131.325 107.243667,123.725 L4.01049167,20.4919833 C-0.581175,15.9003167 -0.581175,8.30031667 4.01049167,3.70865 C8.60215833,-0.883016667 16.2021583,-0.883016667 20.793825,3.70865 L124.027,106.941667 C132.102,115.016667 136.693667,125.941667 136.693667,137.5 C136.693667,149.058333 132.260333,159.983333 124.027,168.058333 L20.793825,271.291667 C18.418825,273.508333 15.4104917,274.775 12.4021583,274.775 Z"
                    id="Path"></path>
              </g>
            </g>
          </svg>
        </button>

      </div>
      <div class="flex lg:justify-between flex-wrap mb-6">
        <div class="flex justify-start lg:w-6/12 w-full">
          <img class="rounded-xl lg:max-h-80 h-full"
               :src="'/storage/' + product.image"
               alt="">
        </div>

        <div class="lg:w-6/12 w-full">
          <h1 class="text-3xl text-gray-800">{{ product.name }}</h1>
          <h1 class="bg-gray-300 text-sm text-gray-700 mt-5 px-3 py-1 inline-block rounded-full">
            {{ product.materials }}
          </h1>
          <p class="text-gray-700 mt-4">
            {{ product.description }}
          </p>

          <div class="mt-4">

            <div class="flex items-center space-x-2">
              <h1 class="text-gray-500">
                Design file:
              </h1>
              <a class="text-primary flex items-center text-sm" :href="'/storage/'+product.design" download>
                <svg class="w-5 h-5 text-primary fill-current mr-2" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z"
                  />
                  <path
                      d="M12 15.25C11.59 15.25 11.25 14.91 11.25 14.5V8.5C11.25 8.09 11.59 7.75 12 7.75C12.41 7.75 12.75 8.09 12.75 8.5V14.5C12.75 14.91 12.41 15.25 12 15.25Z"
                  />
                  <path
                      d="M11.9995 16.2499C11.8095 16.2499 11.6195 16.1799 11.4695 16.0299L8.46945 13.0299C8.17945 12.7399 8.17945 12.2599 8.46945 11.9699C8.75945 11.6799 9.23945 11.6799 9.52945 11.9699L11.9995 14.4399L14.4695 11.9699C14.7595 11.6799 15.2395 11.6799 15.5295 11.9699C15.8195 12.2599 15.8195 12.7399 15.5295 13.0299L12.5295 16.0299C12.3795 16.1799 12.1895 16.2499 11.9995 16.2499Z"
                  />
                </svg>
                Download File
              </a>
            </div>

            <h1>
              <span class="text-gray-500">
              Made for:
              </span>
              {{ product.made_for }}
            </h1>
            <h1>
              <span class="text-gray-500">
                Machines used:
              </span>
              {{ product.machines_used }}
            </h1>
          </div>
          <!--    <panel-item :field="field"/>-->
        </div>

      </div>

    </div>
  </field>

</template>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],
  data() {
    return {
      products: [],
      product: {},
      productIndex: null,
      lastIndex: null,
    }
  },
  methods: {
    getProducts() {
      // let id = this.resource.id.value
      axios.get('/api/products').then(response => {
        this.products = response.data

        this.product = this.products.filter(product => product.id == this.resource.id.value)[0]
        this.productIndex = this.products.indexOf(this.product)
        this.lastIndex = this.products.length - 1


        console.log(this.product)
      })

    },
    paginate(page) {
      if (page == 'next' && this.productIndex < this.lastIndex) {

        this.product = this.products[this.productIndex + 1]
        this.productIndex = this.productIndex + 1
        console.log(this.product)

      } else if (page == 'previous' && this.productIndex >= 1) {
        this.product = this.products[this.productIndex - 1]
        this.productIndex = this.productIndex - 1

      }
    }

  },
  mounted() {
    this.getProducts()
  }
}
</script>
