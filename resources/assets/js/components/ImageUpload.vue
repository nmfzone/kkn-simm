<template>
  <div class="image-input">
    <div class="image-wrapper">
      <i v-show="! imageSrc" class="icon fa fa-picture-o"></i>
      <img v-show="imageSrc" class="image" :src="imageSrc">
    </div>

    <div class="input-wrapper">
      Choose
      <input @change="previewThumbnail" class="input" :name="inputName" type="file">
    </div>
  </div>
</template>

<script>
    export default {
      data() {
        return {
          imageSrc: '',
          inputName: 'photo'
        }
      },
      methods: {
        previewThumbnail: function(event) {
          var input = event.target;

          if (input.files && input.files[0]) {
            var reader = new FileReader();
            var self = this;

            reader.onload = function(e) {
              self.imageSrc = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
          }
        }
      }
    }
</script>
