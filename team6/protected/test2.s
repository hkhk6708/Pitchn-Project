.pos 0x100

main:	irmovl bottom,  %esp     # initialize stack

	xorl   %eax, %eax        # %eax = 0
	mrmovl size(%eax), %eax  # %eax = size
	irmovl $1, %ebx
	subl   %ebx, %eax        # %eax = size - 1
	

	
	call   test
	halt


test:

	irmovl $14, %eax
	irmovl 0xa, %ebx
	#xorl %esi, %esi			# esi = 0
	irmovl $8, %esi
	mrmovl value(%esi), %esi	#esi = value[2]


	ret							#return from call

#
# Array to sort
#
.pos 0x1000
heap:	.long 3
        .long 14
        .long 5
        .long 2
        .long 22
		.long 16
		.long 11
		.long 12
		.long 9
		.long 13
		.long 15
		.long 1
		.long 4
		.long 18
size:   .long 14

value:
		.long 123456
		.long 0x1E240
		.long 0x40E201

#
# Stack (32 thirty-two bit words is more than enough here).
#
.pos 0x3000
top:	            .long 0x00000000,0x20     # top of stack.
bottom:             .long 0x00000000          # bottom of stack.