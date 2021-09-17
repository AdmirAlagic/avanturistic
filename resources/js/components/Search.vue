<template>
    <div class="kt-portlet " style="padding-bottom:0;t">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="kt-searchbar ">
                        <div class="input-group">
                            <div class="input-group-prepend" style="cursor:pointer;" >
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="/img/search.svg" style="width:16px;" alt="">
                                </span></div>
                            <input type="text"  v-model="query" class="form-control" autocomplete="false"  name="query" placeholder="Start typing to explore" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
            </div>
                 
            <p class="text-gray" style="margin-top:5px;margin-bottom:0;"><small>
                Search for users, countries and adventure locations</small></p>

            <div v-html="this.results"></div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import _, { map } from 'underscore';
    export default {
        data: () => ({
            query:null,
            results:null
        }),
        mounted() {
            console.log('Component mounted.')
        },
        watch: {
             query: function (val) {
               
                this.searchQueryDebounce(val);
            },
        },
        methods: {
            searchQueryDebounce: _.debounce(function (query) {
                this.searchQuery(query);
            }, 500),
            searchQuery(query) {
                this.csrf = window.csrfToken;
                 
                axios({
                    url: '/postSearch?query=' + query,
                    headers: {
                        'X-CSRF-TOKEN': window.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                 }).then((res) =>  {
                    
                    this.results = res.data;
                    
                });
            }
        }
    }
</script>
