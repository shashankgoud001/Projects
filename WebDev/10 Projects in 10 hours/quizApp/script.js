const quizData = [
    {
        question: 'How old is Florin?',
        a: '10',
        b: '17',
        c: '26',
        d: '110',
        correct: 'c',
    },{
        question: 'What is the most used programming language in 2019?',
        a:'Java',
        b:'C',
        c:'Python',
        d:'JavaScript',
        correct:'a',
    },{
        question: 'Who is the President of US?',
        a:'Florin Pop',
        b:'Donald Trump',
        c:'Ivans Saldano',
        d:'Mihai Andrei',
        correct:'b',
    },{
        question: 'What does HTML stand for?',
        a:'Hyper Text Markup Language',
        b:'Cascading Style Sheet',
        c:'Jason Object Notation',
        d:'Helicopters Terminals Motors Lambs',
        correct:'a',
    },{
        question:'What year was JavaScript launched?',
        a:'1996',
        b:'1995',
        c:'1994',
        d:'none of the above',
        correct:'b',
    }
];

const questionE1 = document.getElementById("question");
const a_text = document.getElementById('a_text');
const b_text = document.getElementById('b_text');
const c_text = document.getElementById('c_text');
const d_text = document.getElementById('d_text');
const submitBtn = document.getElementById('submit');
let currentQuiz = 0;
let answer = undefined;
let score = 0;
loadQuiz();

function loadQuiz() {
    const currentQuizData = quizData
    [currentQuiz];
    
    questionE1.innerText = currentQuizData.question;

    a_text.innerText = currentQuizData.a;
    b_text.innerText = currentQuizData.b;
    c_text.innerText = currentQuizData.c;
    d_text.innerText = currentQuizData.d;

}

function getSelected() {
    const answers = document.querySelectorAll("answer");

    answers.forEach(answer=>{
        if(answer.checked) {
            return answerE1.id;
        }
    });
    return undefined;

}

submitBtn.addEventListener('click', () => {
    currentQuiz++;

    const answer = getSelected();
    if(answer === )

    if(answer) {
        // if(currentQuiz<quizData.length){
        //     loadQuiz();
        // }else{
        //     // TODO: Show results
        //     alert("You finished! Get yourself an Orange Lemonade");
        // }
    }

})