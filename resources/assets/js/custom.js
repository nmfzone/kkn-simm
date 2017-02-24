$(function() {
  var deleter = {
    elementSelector       : ".the-tables",
    classSelector         : ".delete-this",
    modalTitle            : "Apa anda yakin?",
    modalMessage          : "Kamu tidak akan dapat mengembalikan data ini.",
    modalConfirmButtonText: "Ya, hapus sekarang!",
    laravelToken          : null,
    url                   : "/",

    init: function() {
      $(this.elementSelector).on('click', this.classSelector, {self:this}, this.handleClick);
    },

    handleClick: function(event) {
      event.preventDefault();

      var self = event.data.self;
      var link = $(this);

      self.modalTitle             = link.data('title') || self.modalTitle;
      self.modalMessage           = link.data('message') || self.modalMessage;
      self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
      self.url                    = link.attr('href');
      self.laravelToken           = $("meta[name=csrf-token]").attr('content');

      self.confirmDelete();
    },

    confirmDelete: function() {
      swal({
        title             : this.modalTitle,
        text              : this.modalMessage,
        type              : "warning",
        showCancelButton  : true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText : this.modalConfirmButtonText,
        closeOnConfirm    : true
      },
      function() {
        this.makeDeleteRequest()
      }.bind(this));
    },

    makeDeleteRequest: function() {
      var form =
        $('<form>', {
          'method': 'POST',
          'action': this.url
        });

      var token =
        $('<input>', {
          'type': 'hidden',
          'name': '_token',
          'value': this.laravelToken
        });

      var hiddenInput =
        $('<input>', {
          'name': '_method',
          'type': 'hidden',
          'value': 'DELETE'
        });

      return form.append(token, hiddenInput).appendTo('body').submit();
    }
  };
  deleter.init();

  var banned = {
    elementSelector       : ".the-tables",
    classSelector         : ".banned-this",
    modalTitle            : "Apa anda yakin?",
    modalMessage          : "Pengguna akan di banned.",
    modalConfirmButtonText: "Ya, banned sekarang!",
    laravelToken          : null,
    url                   : "/",

    init: function() {
      $(this.elementSelector).on('click', this.classSelector, {self:this}, this.handleClick);
    },

    handleClick: function(event) {
      event.preventDefault();

      var self = event.data.self;
      var link = $(this);

      self.modalTitle             = link.data('title') || self.modalTitle;
      self.modalMessage           = link.data('message') || self.modalMessage;
      self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
      self.url                    = link.attr('href');
      self.laravelToken           = $("meta[name=csrf-token]").attr('content');

      self.confirmBanned();
    },

    confirmBanned: function() {
      swal({
        title             : this.modalTitle,
        text              : this.modalMessage,
        type              : "warning",
        showCancelButton  : true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText : this.modalConfirmButtonText,
        closeOnConfirm    : true
      },
      function() {
        this.makeBannedRequest()
      }.bind(this));
    },

    makeBannedRequest: function() {
      var form =
        $('<form>', {
          'method': 'POST',
          'action': this.url
        });

      var token =
        $('<input>', {
          'type': 'hidden',
          'name': '_token',
          'value': this.laravelToken
        });

      return form.append(token).appendTo('body').submit();
    }
  };
  banned.init();

  var unbanned = {
    elementSelector       : ".the-tables",
    classSelector         : ".unbanned-this",
    modalTitle            : "Apa anda yakin?",
    modalMessage          : "Pengguna akan di unbanned.",
    modalConfirmButtonText: "Ya, unbanned sekarang!",
    laravelToken          : null,
    url                   : "/",

    init: function() {
      $(this.elementSelector).on('click', this.classSelector, {self:this}, this.handleClick);
    },

    handleClick: function(event) {
      event.preventDefault();

      var self = event.data.self;
      var link = $(this);

      self.modalTitle             = link.data('title') || self.modalTitle;
      self.modalMessage           = link.data('message') || self.modalMessage;
      self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
      self.url                    = link.attr('href');
      self.laravelToken           = $("meta[name=csrf-token]").attr('content');

      self.confirmUnbanned();
    },

    confirmUnbanned: function() {
      swal({
        title             : this.modalTitle,
        text              : this.modalMessage,
        type              : "warning",
        showCancelButton  : true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText : this.modalConfirmButtonText,
        closeOnConfirm    : true
      },
      function() {
        this.makeUnbannedRequest()
      }.bind(this));
    },

    makeUnbannedRequest: function() {
      var form =
        $('<form>', {
          'method': 'POST',
          'action': this.url
        });

      var token =
        $('<input>', {
          'type': 'hidden',
          'name': '_token',
          'value': this.laravelToken
        });

      return form.append(token).appendTo('body').submit();
    }
  };
  unbanned.init();
});
