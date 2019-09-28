
function validate()
{
	checkEmail();
}

function checkEmail()
{
	var em = document.getElementById("RegisterEmail").value;

	var count = 0,lencount = 0,countdot = 0,index = 0,blank = 0,spl = 0,countalpha = 0;
	var name = "";
	var back = "";
	var send = "";

	for(let i = 0;i < em.length; i++)
	{
		if(em.charAt(i) == "@")
			{
				count++;
				index = i;
			}
		else if(em.charAt(i) == " ")
			blank++;
		else if(isSplCharNew(em.charAt(i)))
			spl++;
	}
	if(count == 1 && blank == 0 && spl == 0)
	{
		//var atIndex = em.includes("@");
		for(let i = 0;i < index; i++)
		{
			name += em.charAt(i); 
			if(isAlpha(em.charAt(i)))
				countalpha++;
		}
		
		for(let i = index+1;i < em.length; i++)
		{
			back += em.charAt(i);
			if(em.charAt(i) == ".")
				countdot++;
		}
		if((countdot == 1 || countdot == 2) && countalpha > 0)
		{
			for(let i = 0;i < back.length; i++)
			{
				if(isSplCharNew(back.charAt(i)))
				{
					send = "Invalid E-mail";
					break;
				}
				if(isNumber(back.charAt(i)))
				{
					send = "Invalid E-mail";
					break;
				}
				if(back.charAt(i) == ".")
				{	
					for(let j = i+1;j < back.length; j++)
					{
						if(back.charAt(j) != ".")
						{
							lencount++;
						}
						else break;
					}
					if(lencount == 2 || lencount == 3)
					{
						send = "Valid E-mail";
					}
					else {
						send = "Invalid E-mail";
						break;
					} 
					lencount = 0;
				}

			}
		}
		else send = "Invalid E-mail";
	}
	else
		send = "Invalid E-mail";
	if(name == "")
		send = "Invalid E-mail";
	
	document.getElementById("checkemail").innerHTML = send;
}

function isSplCharNew(ch)
{
	var format = /[!#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/g;
	var em = document.getElementById("RegisterEmail").value;
	
	if(format.test(em))
		return true;
	return false;
}
function isNumber(ch)
{
	if(ch>='0' && ch<='9')
		return true;
	return false;
}
function isAlpha(ch)
{
	if((ch>='A' && ch<='Z') || (ch>='a' && ch<='z'))  
		return true;
	return false;
}