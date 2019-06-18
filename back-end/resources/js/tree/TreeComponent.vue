<template>
    <branch-component :branch="{id: 0, name: 'Expand tree'}" :actions-disabled="true"></branch-component>
</template>

<script>
    import BranchComponent from "./branch/BranchComponent";

    export default {
        name: "TreeComponent",
        components: {BranchComponent}
    }
</script>