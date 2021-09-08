<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <!-- <div v-bind="window.Laravel.user">{window.Laravel.user}</div> -->
                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return{
                
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
