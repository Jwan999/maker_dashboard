<style>
.img-border-color {
  border: 5px solid var(--primary-dark);
}
</style>

<template>
  <field>


    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <div>
      <div class="flex justify-end space-x-4 lg:mb-0 mb-4">
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

      <div class="flex flex-wrap lg:space-x-16 space-x-0 items-center my-10">
        <div class="w-full lg:w-auto flex justify-center">
          <img class="rounded-full h-60 w-60 shadow object-cover img-border-color"
               :src="'/storage/' + trainer.image"
               alt="">
        </div>
        <div class="w-full lg:w-auto">
          <h1 class="text-gray-700 text-lg mt-2">
            <span class="text-gray-500">
            Name:
          </span> {{ trainer.name }}</h1>
          <h1 class="text-gray-700 text-lg mt-2">
            <span class="text-gray-500">
            Phone Number:
          </span> {{ trainer.phone }}</h1>
          <h1 class="text-gray-700 text-lg mt-2">
            <span class="text-gray-500">
            Email Address:
          </span> {{ trainer.email }}</h1>
          <h1 class="text-gray-700 text-lg mt-2 capitalize">{{ trainer.type }} Trainer</h1>
        </div>
      </div>

    </div>
  </field>
  <!--    <panel-item :field="field" />-->
</template>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],
  data() {
    return {
      trainers: [],
      trainer: {},
      trainerIndex: null,
      lastIndex: null,
    }
  },
  methods: {
    getTrainers() {

      // let id = this.resource.id.value
      axios.get('/api/trainers').then(response => {
        this.trainers = response.data

        this.trainer = this.trainers.filter(trainer => trainer.id == this.resource.id.value)[0]
        this.trainerIndex = this.trainers.indexOf(this.trainer)
        this.lastIndex = this.trainers.length - 1
        console.log(this.trainer)
        console.log(this.trainer)
      })

    },
    paginate(page) {
      if (page == 'next' && this.trainerIndex < this.lastIndex) {

        this.trainer = this.trainers[this.trainerIndex + 1]
        this.trainerIndex = this.trainerIndex + 1
        console.log(this.trainer)
        this.$router.push({name: "details", resourceName: "trainers", resourceId: this.trainer.id})
        console.log(this.resourceId)


      } else if (page == 'previous' && this.trainerIndex >= 1) {
        this.trainer = this.products[this.trainerIndex - 1]
        this.trainerIndex = this.trainerIndex - 1
        this.$router.push({name: "details", resourceName: "trainers", resourceId: this.product.id})


      }
    }

  },
  mounted() {
    this.getTrainers()
  }
}
</script>