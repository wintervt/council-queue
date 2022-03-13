<template>
    <div class="flex flex-grow flex-col relative">
        <div class="container mx-auto">

            <div v-if="!loading" class="py-2 -mx-2 md:flex flex-wrap">

                <div v-if="error" class="w-full py-2 px-2">
                    <p class="text-sm text-red-700">Error: {{ error }}</p>
                </div>

                <div class="w-full md:w-2/5 px-2">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">Add New Customer</div>
                    </div>
                    <div class="card-body">

                      <div v-if="services.length > 0" class="pb-3 border-b">
                          <div class="form-group">
                              <p class="mb-2 text-sm font-medium text-gray-800">Services</p>

                              <div class="flex items-center mb-1" v-for="service in services" :key="service.id">
                                  <input v-model="queue.service_id" :id="service.id" :name="service.id" :value="service.id" type="radio" class="radio-button" />
                                  <label :for="service.id" class="ml-3 block text-sm font-medium text-gray-700">{{ service.name }}</label>
                              </div>
                              <div class="invalid-message" v-if="validation('service_id')">{{ validation('service_id') }}</div>
                          </div>
                      </div>

                      <div v-if="customer_types.length > 0" class="pb-3">
                          <div class="form-group md:flex items-center">
                              <div class="pr-2 mb-2 md:mb-0" v-for="customer_type in customer_types" :key="customer_type.id">
                                  <label class="radio-group" :class="{ 'active' : customer_type.id == queue.customer_type_id}">
                                      <input type="radio" name="customer_type" :value="customer_type.id" @change="setCustomerType(customer_type.id, customer_type.name)" class="sr-only">
                                      <p id="memory-option-0-label">{{ customer_type.name }}</p>
                                  </label>
                              </div>
                          </div>
                          <div class="invalid-message" v-if="validation('customer_type_id')">{{ validation('customer_type_id') }}</div>
                      </div>

                      <div v-if="queue.customer_type_name !== 'Anonymous'" class="pt-3 border-t">
                          <div v-if="queue.customer_type_name == 'Citizen'">
                              <div class="form-group">
                                  <label class="form-label" for="title">Title*</label>
                                  <select name="title" id="title" class="form-control form-control-block" v-model="queue.customer_title">
                                      <option value="Mr." selected>Mr.</option>
                                      <option value="Miss">Miss</option>
                                      <option value="Mrs.">Mrs.</option>
                                      <option value="Ms.">Ms.</option>
                                  </select>
                                  <div class="invalid-message" v-if="validation('customer_title')">{{ validation('customer_title') }}</div>
                              </div>
                              <div class="form-group">
                                  <label class="form-label" for="first_name">First Name*</label>
                                  <input type="text" id="first_name" class="form-control form-control-block" v-model="queue.customer_first_name">
                                  <div class="invalid-message" v-if="validation('customer_first_name')">{{ validation('customer_first_name') }}</div>
                              </div>
                              <div class="form-group">
                                  <label class="form-label" for="last_name">Last Name*</label>
                                  <input type="text" id="last_name" class="form-control form-control-block" v-model="queue.customer_last_name">
                                  <div class="invalid-message" v-if="validation('customer_last_name')">{{ validation('customer_last_name') }}</div>
                              </div>
                          </div>

                          <div v-else-if="queue.customer_type_name == 'Organisation'">
                              <div class="form-group">
                                  <label class="form-label" for="organisation_name">Organisation Name*</label>
                                  <input type="text" id="organisation_name" class="form-control form-control-block" v-model="queue.customer_organisation_name">
                                  <div class="invalid-message" v-if="validation('customer_organisation_name')">{{ validation('customer_organisation_name') }}</div>
                              </div>
                          </div>
                      </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn" @click="store()" :disabled="submitting">Add to Queue</button>
                        <div class="success-message" v-if="success">
                            {{ success }}
                        </div>
                    </div>
                  </div>
                </div>

                <div class="w-full md:w-3/5 px-2">

                    <div class="py-3 px-3">
                        <h2 class="leading-5 text-gray-700 font-light">Current Queue</h2>
                    </div>

                    <div v-if="queues.length === 0">
                        <div class="py-2">
                            <p class="text-sm text-blue-700">There are no customers in the queue currently</p>
                        </div>
                    </div>

                    <div v-else class="shadow overflow-x-scroll border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="queue-table-heading">#</th>
                                <th scope="col" class="queue-table-heading">Type</th>
                                <th scope="col" class="queue-table-heading">Name</th>
                                <th scope="col" class="queue-table-heading">Service</th>
                                <th scope="col" class="queue-table-heading">Queued at</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="queue in queues" :key="queue.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ queue.id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ queue.customer_type.name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ queue.customer_name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ queue.service.name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    <div class="text-sm text-gray-500">{{ queue.created_at }}</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>

</template>

<script>
 import _ from "lodash"

export default {
    data () {
        return {
            queue: {},
            queues: [],
            services: [],
            customer_types: [],
            error: null,
            errors: {},
            success: null,
            loading: false,
            submitting: false,
        }
    },
    created () {
        this.fetch()
    },
    methods: {
        fetch () {
            this.loading = true
            axios.get('/queue')
                .then(response => {
                    this.loading = false
                    this.queues = response.data.queues
                    this.services = response.data.services
                    this.customer_types = response.data.customer_types
                }).catch(error => {
                    this.loading = false
                    this.error = error.response.data.message || error.toString()
            })
        },
        store () {
            this.success = null
            this.error = null
            this.errors = {}
            this.submitting = true

            axios.post('/queue', this.queue)
                .then(response => {
                    this.submitting = false
                    this.success = response.data.message
                    this.fetch()
                }).catch(error => {
                    this.submitting = false
                    this.error = error.response.data.message || error.toString()
                    this.errors = error.response.data.errors
            })
        },
        validation(field) {
            if (this.errors.hasOwnProperty(field)) {
                return _.first(this.errors[field])
            }

            return null
        },
        setCustomerType(customerTypeId, customerTypeName) {
            this.queue.customer_type_id = customerTypeId;
            this.queue.customer_type_name = customerTypeName;
        }
    }
}
</script>

