$.validator.addMethod("alphaSpace", function(value, element) {
    return this.optional(element) || /^[A-Za-z\s]+$/i.test(value);
}, $.validator.messages.alphaSpace);