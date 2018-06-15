<template>
    <div class="container mx-auto">

        <div class="flex justify-center">
            <div class="w-1/3 justify-center bg-blue-darker" v-if="match">
                <div class="text-white flex justify-center bg-blue-darkest">{{match.time}}</div>
                <div class="flex justify-center text-white">
                <span class="w-1/2 text-right">
                        {{match.home_team.country}}
                    <span class="text-2xl ml-2 mr-2">
                    {{match.home_team.goals}}
                </span>
                </span>

                    <span class="w-1/2">
                    <span class="text-2xl ml-2 mr-2">
                    {{match.away_team.goals}}
                </span>
                        {{match.away_team.country}}
                </span>
                </div>

            </div>
        </div>


    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        methods: {
            loadData: function () {
                axios.get(`https://world-cup-json.herokuapp.com/matches/current`)
                    .then(response => {
                        // JSON responses are automatically parsed.

                        if (response.data === undefined || response.data.length == 0) {
                            this.match = null;
                        } else {
                            this.match = response.data[0];
                        }

                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            }
        },
        mounted() {

            this.loadData();

            setInterval(function () {
                this.loadData();
            }.bind(this), 60000);

        },
        data() {
            return {
                match: null,
                errors: []
            }
        },

        // Fetches posts when the component is created.
        created() {

        }
    }
</script>
