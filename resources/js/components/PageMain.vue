<template>
    <div>
        <div class="page-header mb-4">
            <div class="row">
                <div class="col-12">
                    <slot name="head"></slot>
                </div>
            </div>
        </div>
        <div class="paga-content">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid">
                        <slot name="content"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'PageMain'
}
</script>