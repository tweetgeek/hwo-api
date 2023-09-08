<template>
    <NotFound v-if="pageNotFound"/>
    <div v-else-if="canShowContent">
        <RenderContent
            model="page"
            :content="content"
            :api-key="apiKey"
        />
    </div>
</template>
<script>
// OR use this one if you are on Vue 3
import {getContent, isPreviewing, RenderContent} from '@builder.io/sdk-vue/vue3';
// import your NotFoundComponent
import NotFoundComponent from './components/NotFound.vue';

// define vue component
export default {
    name: 'App',
    // Use Builder's RenderContent to show your Builder content
    // Add NotFoundComponent to use in case of no content
    components: {
        RenderContent,
        NotFound: NotFoundComponent,
    },
    data: () => ({
        // boolean to control showing content
        canShowContent: false,
        // content variable to store content from Builder
        content: null,
        // use API key
        apiKey: '5a57f05dee8542329aceb2f76e57d9bc', //BUILDER_PUBLIC_API_KEY,
    }),
    // mounted() lifecycle hook called after component is in the DOM
    mounted() {
        // get page model from space (specified by the Public API Key)
        // and the URL
        console.log('window.location.pathname', window.location.pathname)
        getContent({
            model: 'page',
            apiKey: 'e5d993f0b6454e91ba140fe48770fb90', //YOUR_PUBLIC_API_KEY, // <-- Replace with your Public API Key
            // apiKey: '5a57f05dee8542329aceb2f76e57d9bc', //YOUR_PUBLIC_API_KEY, // <-- Replace with your Public API Key
            userAttributes: {
                urlPath: window.location.pathname,
            },
        }).then(res => {
            // sets content to results of getContent()
            this.content = res;
            // If there's content or if the page is being viewed in the Visual Editor,
            // set canShowContent to true.
            this.canShowContent = this.content || isPreviewing();
            // If no content is found, set pageNotFound to true.
            // This is used in the template to conditionally render 404 component.
            if (!this.content) {
                this.pageNotFound = true;
            }
        });
    },
    computed: {
        // Provide a default title and default description in case there is no content
        computedTitle() {
            return this.content?.data?.title || 'Default title';
        },
        computedDescription() {
            return this.content?.data?.description || 'Default description';
        },
    },
}
</script>
