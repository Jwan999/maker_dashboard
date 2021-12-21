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
                        :class="startupIndex >= 1 ? 'bg-primary text-white': 'bg-gray-300 text-gray-600'"
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
                <button @click="paginate('next')"
                        :class="startupIndex < lastIndex ? 'bg-primary text-white': 'bg-gray-300 text-gray-600'"
                        class="bg-primary text-sm text-white px-5 py-2 rounded-lg font-bold">
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

            <div class="flex items-center space-x-6">
                <div class="">
                    <img class="rounded-full shadow object-cover img-border-color h-52 w-52 p-4"
                         src="https://logos-world.net/wp-content/uploads/2020/12/Lays-Logo.png"
                         alt="">
                </div>
                <div class="w-8/12">
                    <!--:src="'/storage/' + startup.logo"-->
                    <h1 class="text-3xl text-gray-900">{{ startup.name }}</h1>
                    <p class="text-lg text-gray-700">
                        {{ startup.idea }}
                    </p>
                </div>
            </div>
            {{ startup.founders }}
            <div class="mt-6">
                <div>
                    <!--                    v-for="founder in startup.founders"-->
                    <!--                    {{ startup }}-->
                    <h1 class="text-gray-500">Founder name: <span class="text-gray-900"></span></h1>
                    <h1 class="text-gray-500">Email: <span class="text-gray-900"></span></h1>
                    <h1 class="text-gray-500">Phone: <span class="text-gray-900"></span></h1>
                </div>
                <div class="mt-3">
                    <h1 class="text-gray-500">Location: <span class="text-gray-900">{{ startup.location }}</span></h1>
                    <h1 class="text-gray-500">Started since: <span class="text-gray-900">
                        {{ new Date(startup.started_since).getFullYear() }}
                    </span></h1>

                </div>
            </div>
            <div class="flex space-x-2 mt-6">
                <a :href="startup.facebook">
                    <svg class="w-8 h-8" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                        <g fill-rule="evenodd">
                            <path
                                d="m32 64h-16a16.0007 16.0007 0 0 1 -16-16v-32a16.0007 16.0007 0 0 1 16-16h32a16 16 0 0 1 16 16v32a16 16 0 0 1 -16 16h-6a5 5 0 0 0 -10 0z"
                                fill="#3764b9"/>
                            <path
                                d="m30 18h18a9.0006 9.0006 0 0 0 .92-17.954c-.306-.017-.609-.046-.92-.046h-32a16.0007 16.0007 0 0 0 -16 16v32a30.0007 30.0007 0 0 1 30-30"
                                fill="#507dd2"/>
                            <path d="m48 32a16 16 0 1 0 16 16v-32a16 16 0 0 1 -16 16" fill="#1e4ba0"/>
                            <path
                                d="m52 18a2 2 0 0 1 -2 2h-6a2 2 0 0 0 -2 2v8h7.56a2 2 0 0 1 1.9612 2.392c-.3713 1.857-.8757 4.379-1.2 6a2 2 0 0 1 -1.9612 1.608h-6.36v24h-10v-24h-6a2 2 0 0 1 -2-2v-6a2 2 0 0 1 2-2h6v-8a12 12 0 0 1 12-12h6a2 2 0 0 1 2 2z"
                                fill="#fff"/>
                        </g>
                    </svg>
                </a>
                <a :href="startup.insta">
                    <svg class="w-8 h-8" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                        <g fill-rule="evenodd">
                            <path
                                d="m48 64h-32a16.0007 16.0007 0 0 1 -16-16v-32a16.0007 16.0007 0 0 1 16-16h32a16 16 0 0 1 16 16v32a16 16 0 0 1 -16 16"
                                fill="#ff3a55"/>
                            <path
                                d="m30 18h18a9.0006 9.0006 0 0 0 .92-17.954c-.306-.017-.609-.046-.92-.046h-32a16.0007 16.0007 0 0 0 -16 16v32a30.0007 30.0007 0 0 1 30-30"
                                fill="#ff796c"/>
                            <path d="m48 32a16 16 0 1 0 16 16v-32a16 16 0 0 1 -16 16" fill="#e00047"/>
                        </g>
                        <circle cx="44.5" cy="19.5" fill="#fff" r="2.5"/>
                        <path
                            d="m32 24a8 8 0 1 1 -8 8 8.0042 8.0042 0 0 1 8-8zm0-4a12 12 0 1 1 -12 12 12.0057 12.0057 0 0 1 12-12z"
                            fill="#fff" fill-rule="evenodd"/>
                        <path
                            d="m52 22a10 10 0 0 0 -10-10h-20a10 10 0 0 0 -10 10v20a10 10 0 0 0 10 10h20a10 10 0 0 0 10-10zm4 0a14 14 0 0 0 -14-14h-20a14 14 0 0 0 -14 14v20a14 14 0 0 0 14 14h20a14 14 0 0 0 14-14z"
                            fill="#fff" fill-rule="evenodd"/>
                    </svg>

                </a>
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
            startups: [],
            startup: {},
            startupIndex: null,
            lastIndex: null,
        }
    },
    methods: {
        getStartups() {
            axios.get('/api/startups').then(response => {
                this.startups = response.data

                this.startup = this.startups.filter(startup => startup.id == this.resource.id.value)[0]
                this.startupIndex = this.startups.indexOf(this.startup)
                this.lastIndex = this.startups.length - 1

            })

        },
        paginate(page) {
            if (page == 'next' && this.startupIndex < this.lastIndex) {

                this.startup = this.startups[this.startupIndex + 1]
                this.startupIndex = this.startupIndex + 1

                this.$router.push({
                    name: 'detail',
                    params: {
                        resourceId: this.startup.id,
                        resourceName: "startups",
                    }
                });


            } else if (page == 'previous' && this.startupIndex >= 1) {
                this.startup = this.startups[this.startupIndex - 1]
                this.startupIndex = this.startupIndex - 1

                this.$router.push({
                    name: 'detail',
                    params: {
                        resourceId: this.startup.id,
                        resourceName: "startups",
                    }
                });


            }
        }

    },
    mounted() {
        this.getStartups()
    }
}
</script>
