<template>
    <input
        v-imask="mask"
        :id="id"    
        :name="name"
        :value="value"
        :class="classes" 
        :required="required"
    />
</template>

<script>
    import { IMaskDirective } from 'vue-imask';

    export default {
        props: {
            id: {
                type: String,
                required: true
            },
            name: {
                type: String,
                required: true
            },
            classes: {
                type: String,
                required: true
            },
            value: {
                type: String,
                required: false
            },
            required: {
                type: Boolean,
                required: false
            },
        },
        data () {
            return {
                mask: {
                    mask: '{+55} (00) 00000-0000',
                    startsWith: '55',
                    lazy: false,
                    country: 'Brazil'
                }
            }
        },
        directives: {
            imask: IMaskDirective
        }
    }
</script>