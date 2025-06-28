// examiner.js
class Question {
  constructor(question, course, option1, option2, option3, option4, correctAnswer) {
    this.question = question;
    this.course = course;
    this.option1 = option1;
    this.option2 = option2;
    this.option3 = option3;
    this.option4 = option4;
    this.correctAnswer = correctAnswer;
  }

  saveToDatabase() {
    const saveEndpoint = "user.php";
    const j = {
      questionText: this.question,
      course: this.course,
      option1: this.option1,
      option2: this.option2,
      option3: this.option3,
      option4: this.option4,
      correctAnswer: this.correctAnswer
    };

    // Show loading state
    $("#addQuestionBtn").prop("disabled", true).html('<span class="spinner"></span> Saving...');

    $.ajax({
      type: "POST",
      url: saveEndpoint,
      data: JSON.stringify(j),
      contentType: "application/json",
      success: (response) => {
        try {
          const result = typeof response === 'string' ? JSON.parse(response) : response;

          if (result.status === "success") {
            this.showNotification("Question saved successfully!", "success");
            $("#questionForm")[0].reset();
          } else {
            this.showNotification(`Error: ${result.message || "Unknown error"}`, "error");
          }
        } catch (e) {
          this.showNotification("Error parsing server response", "error");
          console.error("Parse error:", e, response);
        }
      },
      error: (xhr) => {
        this.showNotification(`Server error: ${xhr.status} ${xhr.statusText}`, "error");
        console.error("AJAX Error:", xhr.responseText);
      },
      complete: () => {
        $("#addQuestionBtn").prop("disabled", false).text("Add Question");
      }
    });
  }

  showNotification(message, type) {
    const notification = $(`<div class="notification ${type}">${message}</div>`);
    $(".container").prepend(notification);
    setTimeout(() => notification.fadeOut(500, () => notification.remove()), 3000);
  }
}

$(document).ready(function () {
  $("#addQuestionBtn").click(function (event) {
    event.preventDefault();

    // Input validation
    const inputs = [
      $("#questionInput"),
      $("#courseInput"),
      $("#option1"),
      $("#option2"),
      $("#option3"),
      $("#option4")
    ];

    let isValid = true;
    inputs.forEach(input => {
      if (!input.val().trim()) {
        input.addClass("error");
        isValid = false;
      } else {
        input.removeClass("error");
      }
    });

    if ($("#correctAnswerInput").val() === "") {
      $("#correctAnswerInput").addClass("error");
      isValid = false;
    } else {
      $("#correctAnswerInput").removeClass("error");
    }

    if (!isValid) {
      $(".notification").remove();
      $(".container").prepend(
        '<div class="notification error">Please fill all fields!</div>'
      );
      return;
    }

    const questionInstance = new Question(
      $("#questionInput").val().trim(),
      $("#courseInput").val().trim(),
      $("#option1").val().trim(),
      $("#option2").val().trim(),
      $("#option3").val().trim(),
      $("#option4").val().trim(),
      $("#correctAnswerInput").val()
    );

    questionInstance.saveToDatabase();
  });

  // Clear error on focus
  $("input, textarea, select").on("focus", function () {
    $(this).removeClass("error");
  });
});