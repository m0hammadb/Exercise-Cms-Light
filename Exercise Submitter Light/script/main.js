String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};


function CheckCode(r)
{
	var v = 0;
	
		var inp = document.getElementById("exCode").value;
	inp = inp.replaceAll("-","_");
	if(r==1)
		document.getElementById("exCode").value=inp;
	var spl = inp.split("_");
	if(spl.length >= 5)
	{
		dYear=spl[2];
		dMonth=spl[3];
		dDay=spl[4];
		if(isValidJalaaliDate(dYear,dMonth,dDay))
		{
			v=1;
			document.getElementById("deadLine").value=dYear + "/" + dMonth + "/" + dDay; 
		}
	}
	if(v==0)
	{
		document.getElementById("deadLine").value="کد تمرین معتبر نیست";
	}
}

function isValidJalaaliDate(jy, jm, jd) {
  return  jy >= -61 && jy <= 3177 &&
          jm >= 1 && jm <= 12 &&
          jd >= 1 && jd <= jalaaliMonthLength(jy, jm)
}

function isLeapJalaaliYear(jy) {
  return jalCal(jy).leap === 0
}

function jalaaliMonthLength(jy, jm) {
  if (jm <= 6) return 31
  if (jm <= 11) return 30
  return 29
}

timer=setInterval("CheckCode(0)",1000);