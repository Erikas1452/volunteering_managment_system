<template>
<div class="form-group">
    <fieldset>
        <input @click="isChecked" type="checkbox" id="checkbox_1" name="documents_needed"
            value="0">
        <label for="checkbox_1">Reikalingas dokumentų pasirašymas</label>
    </fieldset>
    <div class="row" v-if="display">
        <div class="col-md-6">
            <h6 class="mb-0">Organizacijos validumą patvirtinantis dokumentas priimami formatai (.pdf)*</h6>
        </div>
        <div class="col-md-6 text-secondary">
            <div class="form-group"> <input type="file" name="upload_file" class="form-control"> </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data: () => ({
        display: false,
    }),
    methods:{
        isChecked(e){
            if (e.target.checked){
                this.display = true;
            }
            else this.display = false;
        }
    },
}
</script>