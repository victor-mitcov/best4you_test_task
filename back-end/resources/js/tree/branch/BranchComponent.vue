<template>
    <div>
        <div>
            <div style="cursor: pointer;">
                <span @click="toggleChildren">
                    <span>{{ symbolExpanded }}</span>
                    <span v-if="!edit">{{ branch.name }}</span>
                </span>

                <template v-if="!actionsDisabled">
                    <input v-if="edit" type="text" v-model="branch.name">

                    <button v-if="!edit" @click="edit = true" type="button" class="btn btn-primary btn-sm">Edit</button>
                    <button v-if="!edit" @click="deleteBranch" type="button" class="btn btn-danger btn-sm">Delete</button>
                    <button v-if="!edit" @click="addChild" type="button" class="btn btn-info btn-sm">Add child</button>

                    <template v-if="edit">
                        <button @click="updateBranch" type="button" class="btn btn-success btn-sm">Submit</button>
                        <button @click="edit = false" type="button" class="btn btn-secondary btn-sm">Cancel</button>
                    </template>
                </template>
            </div>

        </div>

        <ul v-show="expanded && children.length" class="list-group">
            <li v-for="(child, $i) in children" class="list-group-item">
                <branch-component :branch="child" @listUpdated="setChildren"/>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "BranchComponent",
        props: {
            branch: {
                type: Object
            },
            actionsDisabled: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                expanded: false,
                edit: false,
                children: []
            }
        },
        computed: {
            symbolExpanded: function () {
                return this.expanded ? '[-]' : '[+]'
            },
            actionWord: function () {
                return this.edit ? 'Submit' : 'Edit'
            }
        },
        methods: {
            toggleChildren() {
                console.log('here');

                this.expanded = !this.expanded;

                if (this.expanded) {
                    this.setChildren();
                }
            },
            setChildren() {
                axios.get(`/api/branch/list/${this.branch.id}`)
                    .then(({data}) => {
                        this.children = data;
                    })
                    .catch((error) => console.error(error));
            },
            updateBranch() {
                axios.post(`api/branch/update`, this.branch)
                    .then(() => {
                        this.edit = false;

                        alert(`Item with id=${this.branch.id} was updated`)
                    })
                    .catch((error) => console.error(error));
            },
            deleteBranch() {
                axios.delete(`api/branch/${this.branch.id}`)
                    .then(() => {
                        this.$emit('listUpdated');
                    })
            },
            addChild() {
                let name = prompt('Please, enter the name of branch:');

                if (name) {
                    axios.post(`api/branch/store`, {
                        name,
                        parent_id: this.branch.id
                    }).then(() => {
                        this.setChildren();

                        this.expanded = true;
                    })
                }
            }
        },
    }
</script>