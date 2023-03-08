var firstChoice = document.getElementById('first-choice');
var secondChoice = document.getElementById('second-choice');
var result = document.getElementById('result');

firstChoice.addEventListener('change', function() {
    if (this.value == 'dranken') {
    result.innerHTML = '<a class="filterbtn" href="index.php?cat=dranken">Filter</a>';
    result.style.display = 'block';
    } else if (this.value == 'pizza' || this.value == 'bijgerecht' || this.value == 'all') {
    secondChoice.style.display = 'block';
    secondChoice.children[0].addEventListener('change', function() {
        if (this.value == 'vegetarian') {
            if (firstChoice.value == 'pizza') {
                result.innerHTML = '<a class="filterbtn" href="index.php?cat=pizza&sub_cat=veggi">Filter</a>';
            } else if (firstChoice.value == 'bijgerecht') {
                result.innerHTML = '<a class="filterbtn" href="index.php?cat=bijgerecht&sub_cat=veggi">Filter</a>';
            }else if (firstChoice.value == 'all') {
                result.innerHTML = '<a class="filterbtn" href="index.php?sub_cat=veggi">Filter</a>';
            }
            result.style.display = 'block';
        } else if (this.value == 'all2') {
            if (firstChoice.value == 'pizza') {
                result.innerHTML = '<a class="filterbtn" href="index.php?cat=pizza">Filter</a>';
            } else if (firstChoice.value == 'bijgerecht') {
                result.innerHTML = '<a class="filterbtn" href="index.php?cat=bijgerecht">Filter</a>';
            }else if (firstChoice.value == 'all') {
                result.innerHTML = '<a class="filterbtn" href="index.php">Filter</a>';
            }
            result.style.display = 'block';
        }
    });
    } else {
    secondChoice.style.display = 'none';
    result.style.display = 'none';
    }
});