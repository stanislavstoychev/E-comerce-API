class Notification {
    success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done!',
            timeout: 1000,
        }).show();
    }

    alert() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are you sure?',
            timeout: 1000,
        }).show();
    }
    drawingexist() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'This drawing alrady exists!',
            timeout: 2000,
        }).show();
    }
    
    transmittalexist() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'This drawing is part of the transmittal! ',
            timeout: 3000,
        }).show();
    }
    error() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Something went wrong!',
            timeout: 1000,
        }).show();
    }

    warning() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Opps Wrong',
            timeout: 1000,
        }).show();
    }
    image_validation() {
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Upload image less then 6MB',
            timeout: 1000,
        }).show();
    }

    cart_success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Add to Cart',
            timeout: 1000,
        }).show();
    }

    cart_delete() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Deleted!',
            timeout: 1000,
        }).show();
    }

}
export default Notification = new Notification()
