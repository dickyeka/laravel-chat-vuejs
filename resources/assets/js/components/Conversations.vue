<template>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Semua Obrolan</h3>
    </div>
    <div class="panel-body">
        <div v-if="loading" class="loader"></div>
        <div class="media" v-for="conversation in conversations" v-else-if="conversations.length">
             <div class="media-body">
             <a href="#" @click.prevent="getConversation(conversation.id)" >{{ trunc(conversation.body,50) }}</a>
             <p class="text-muted">
                 You and {{conversation.participant_count}} others
             </p>
              <ul class="list-inline">
                <li>
                    <img v-bind:src="user.avatar" v-bind:title="user.name" v-bind:alt="user.name + ' avatar'" v-for="user in conversation.users.data">
                </li>
                <li>Last reply {{ conversation.last_reply_human }}</li>
            </ul>

             </div>
        </div>
        <div v-else>No conversations</div>
    </div>
</div>
</template>

<script>
    import trunc from '../helpers/trunc'
    import { mapActions, mapGetters } from 'vuex'

    export default {

        computed: mapGetters({
            conversations: 'allConversations',
            loading: 'loadingConversations',
        }),
        methods: {
            ...mapActions([
                'getConversations',
                'getConversation'
            ]),
            trunc: trunc,
        },
        mounted() {
            this.getConversations(1)
        }
    }
</script>
