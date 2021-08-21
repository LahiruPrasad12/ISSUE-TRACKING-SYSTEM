<template>
  <div class="container" style="margin-top: 250px">
    <p class="title is-1" style="text-align: center">
      Comments under one Issue
    </p>
    <hr />

    <!--This occure when user want to add new comment or update exist comment-->
    <div
      v-show="!showContent"
      class="shadow-lg p-3 mb-5 bg-body rounded"
      style="
        width: 700px;
        margin-left: 25%;
        margin-right: -50%;
        margin-top: 50px;
      "
    >
      <p
        v-if="editecomment.id !== 0"
        class="title is-5"
        style="text-align: center"
      >
        Update comment
      </p>
      <p
        v-if="editecomment.id === 0"
        class="title is-5"
        style="text-align: center"
      >
        Add new comment
      </p>
      <hr />

      <b-field label="Comment :">
        <b-input
          v-model="editecomment.Body"
          placeholder="Enter Comment..."
          style="margin-top: 10px"
          required
        ></b-input>
      </b-field>
      <div class="modal-footer">
        <b-button
          type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal"
          @click="closeTextbox()"
          >Close</b-button
        >
        <b-button
          v-if="editecomment.id !== 0"
          type="button"
          class="btn btn-danger"
          :loading="commentStatus"
          @click="updateComment(editecomment.id)"
          >Save changes</b-button
        >
        <b-button
          v-if="editecomment.id === 0"
          type="button"
          class="btn btn-primary"
          :loading="commentStatus"
          @click="postComment()"
          >Post comment</b-button
        >
      </div>
    </div>

    <div v-show="showContent">
      <b-tooltip
        label="Add your new comment regarding this issue"
        size="is-small"
        multilined
      >
        <b-button
          type="is-success"
          outlined
          label="Add New Comment"
          @click="addNewComment()"
        />
      </b-tooltip>

      <div
        v-for="comment in comments"
        :key="comment.id"
        class="shadow-lg p-3 mb-5 bg-body rounded"
        style="width: 700px; margin-left: 25%; margin-right: -50%"
      >
        {{ comment.body }}

        <b-dropdown
          aria-role="list"
          class="is-pulled-right"
          position="is-bottom-left"
        >
          <template #trigger>
            <b-icon icon="dots-vertical"></b-icon>
          </template>
          <b-dropdown-item aria-role="listitem" @click="editComment(comment.id)"
            >Edite</b-dropdown-item
          >
          <b-dropdown-item
            aria-role="listitem"
            @click="confirmCustomDelete(comment.id)"
            >Delete</b-dropdown-item
          >
        </b-dropdown>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  validate({ params }) {
    return /^\d+$/.test(params.subcomment)
  },

  data() {
    return {
      slug: this.$route.params,
      comments: [],
      allcomment: [],
      editecomment: {
        id: 0,
        Body: '',
        issue_id: '',
      },

      commentStatus: false,
      showContent: true,
    }
  },

  async fetch() {
    this.allcomment = await this.fetchAllComments()

    /* eslint-disable no-console */
    console.log(this.allcomment.data)

    if (this.allcomment.data.length === 0) {
      this.alertCustom()
    } else {
      this.comments = this.allcomment.data
    }
  },

  methods: {
    alertCustom() {
      this.$buefy.dialog.alert({
        title: 'Title Alert',
        message: '<b>There have no more comments </b>, for this issue!',
        confirmText: 'Cool!',
      })
    },

    async fetchAllComments() {
      return await this.$axios.get(
        '/comments/issue/' + this.$route.params.subcomment
      )
    },

    addNewComment() {
      this.showContent = false
    },

    async postComment() {
      try {
        this.commentStatus = true
        this.$buefy.toast.open(`Your data is sending...`)
        await this.$axios.post(
          '/comment/' + this.$route.params.subcomment,
          this.editecomment
        )
        this.$buefy.toast.open(`Post comment success!`)
        this.commentStatus = false
      } catch (err) {
        this.$buefy.toast.open(`Something went wrong...Plz try again later!`)
        this.commentStatus = false
      }
    },

    confirmCustomDelete(commentID) {
      try {
        this.$buefy.dialog.confirm({
          title: 'Deleting account',
          message:
            'Are you sure you want to <b>delete</b> this comment? This action cannot be undone.',
          confirmText: 'Delete Account',
          type: 'is-danger',
          hasIcon: true,
          onConfirm: async () => {
            await this.$axios
              .delete('/comment/' + commentID)
              .then(async (res) => {
                const postion = await this.comments.findIndex(
                  (x) => x.id === commentID
                )

                this.comments.splice(postion, 1)
                this.$buefy.toast.open('Comment deleted!')
              })
          },
        })
      } catch {
        this.$buefy.toast.open('Something went wrong!')
      }
    },

    async editComment(commentID) {
      try {
        const respond = (await this.$axios.get('/comment/' + commentID)).data
          .data
        this.editecomment = respond
        this.showContent = false
      } catch (err) {
        this.$buefy.toast.open(`<b>Something went wrong!</b>   ${err}`)
      }
    },

    async updateComment(commentID) {
      try {
        this.commentStatus = true
        this.$buefy.toast.open(`Your data is sending...`)
        await this.$axios.put('/comment/' + commentID, this.editecomment)
        this.$buefy.toast.open(`Update comment success!`)
        this.commentStatus = false
      } catch (err) {
        this.$buefy.toast.open(`<b>Something went wrong..</b> ${err}`)
        this.commentStatus = false
      }
    },

    closeTextbox() {
      this.$router.go()
    },
  },
}
</script>
