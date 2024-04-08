# simple-php-shopping

## 프로젝트 정보

 php로 제작한 간단한 쇼핑몰 사이트입니다.</br>
 구현된 기능은 아래에 나열된 것과 같습니다.</br> 

⭐️ 회원가입 및 로그인 기능</br>
 - 회원가입 페이지에서 유저의 개인 정보를 입력하고, 입력된 정보를 데이터베이스에 저장하여 회원가입을 완료합니다.</br>
 - 저장된 회원 정보를 이용하여 로그인 기능을 구현합니다.</br>

⭐️ 마이 페이지</br>
 - 회원이 자신의 개인 정보를 수정할 수 있는 페이지를 구현합니다.</br>
 
⭐️ 장바구니 기능</br>
 - 로그인한 사용자는 상품 리스트 페이지나 상품 상세 페이지에서 상품을 장바구니에 담을 수 있습니다.</br>
 - 사용자는 장바구니 페이지에서 담은 상품을 확인하고 관리할 수 있습니다.</br>
 
⭐️ 구매 페이지</br>
 - 장바구니에 담은 상품의 가격을 기반으로 총 가격을 계산합니다.</br>
 - 장바구니에 담은 상품 가격이 총 30,000 원을 초과할 경우 무료 배송으로, 30,000 이하인 경우에는 배송비 3,000 원을 포함해서 총 가격 계산합니다.</br>
 - 장바구니에 담은 상품을 구매 진행할 경우, 상품 구매 페이지에서 개인 정보가 자동으로 텍스트 상자에 입력되어 구매를 진행합니다.</br> 
 
⭐️ 검색 기능</br>
 - 사용자는 검색 상자를 통해 키워드를 입력하여 해당 키워드를 포함한 상품을 검색할 수 있습니다.</br>
 
⭐️ 관리자 페이지</br>
 - 관리자는 관리자 아이디와 비밀번호로 로그인하여 관리자 페이지로 접속할 수 있습니다.</br>
 - 관리자 아이디: admin, 관리자 비밀번호: zokj0312</br>
 - 관리자 페이지에서는 상품 등록, 수정, 삭제 기능을 제공합니다.</br>
 - 또한, 회원 관리와 상품 주문 관리 기능도 포함됩니다.</br>
 
⭐️ 페이징 기능</br>
 - 상품이 많은 경우를 대비하여 페이징 기능을 구현하여 페이지네이션을 제공합니다.</br>
 
⭐️ 더보기 버튼</br>
 - 메인 페이지에서 더보기 버튼을 클릭할 경우, 더 많은 상품을 노출합니다.</br>
 
⭐️ 상품 목록 및 상세 페이지</br>
 - 상품 목록 페이지에서는 전체 상품을 노출하고, 상품 상세 페이지에서는 상품의 이름, 이미지, 설명을 자세히 보여줍니다.</br>
 
⭐️ 상품 리뷰 기능</br>
 - 사용자는 상품 상세 페이지에서 별점과 리뷰를 작성하여 상품에 대한 평가를 남길 수 있습니다.</br>

## 시작 가이드

### 설치

```
$ git clone https://github.com/seraphinachan/simple-php-shopping.git
```

### DB 설치

해당 폴더에는 'data_backup.sql' 파일을 포함하고 있습니다.</br>
해당 파일은 데이터베이스 및 테이블 생성 쿼리문을 포함하고 있습니다.</br>
해당 폴더 내의 'dbconfig.php' 에서 사용자가 'localhost' 에서 사용자는 'root' 로, 비밀번호는 '' 로, 데이터베이스는 'shopping' 으로 한다고 가정합니다.</br>
'data_backup.sql' 파일 내의 쿼리문을 실행해서 'shopping' 이라는 이름의 데이터베이스를 생성해주세요. 

## 기술 스택

<img src="https://img.shields.io/badge/Jquery-0769AD?style=for-the-badge&logo=jquery&logoColor=white">

<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">

<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white">

<img src="https://img.shields.io/badge/javascript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white">

<img src="https://img.shields.io/badge/html5-E34F26?style=for-the-badge&logo=html5&logoColor=white"> 

<img src="https://img.shields.io/badge/css3-1572B6?style=for-the-badge&logo=css3&logoColor=white">
